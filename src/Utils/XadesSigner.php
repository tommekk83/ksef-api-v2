<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2\Utils;

use DOMDocument;
use DOMElement;
use DOMException;
use Exception;
use Random\RandomException;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use RuntimeException;

/**
 * XAdES-BES enveloped signer for AuthTokenRequest
 * Requires: robrichards/xmlseclibs
 */
final class XadesSigner
{
    private const string DS_NS = 'http://www.w3.org/2000/09/xmldsig#';
    private const string XADES_NS = 'http://uri.etsi.org/01903/v1.3.2#';

    /**
     * @param DOMDocument $doc The XML to sign (root: AuthTokenRequest).
     * @param string $privateKeyFile Path to PEM private key, or PKCS#12 (.p12/.pfx) when $pkcs12Password is provided.
     * @param string|null $certificateFile Path to PEM certificate (when using PEM). For PKCS#12 leave null.
     * @param string|null $pkcs12Password Password for PKCS#12 container (if using .p12/.pfx).
     * @return DOMDocument Signed XML document (same instance as input).
     * @throws Exception
     */
    public function sign(DOMDocument $doc, string $privateKeyFile, ?string $certificateFile = null, ?string $pkcs12Password = null): DOMDocument
    {
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        [$pemKey, $pemCert] = $this->loadCredentials($privateKeyFile, $certificateFile, $pkcs12Password);

        // Prepare signer
        $dsig = new XMLSecurityDSig();
        $dsig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);

        // Reference the whole document (enveloped) + Exclusive C14N
        $dsig->addReference(
            $doc,
            XMLSecurityDSig::SHA256,
            [
                'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
                XMLSecurityDSig::EXC_C14N,
            ],
            ['uri' => '']
        );

        // Sign with RSA-SHA256
        $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, ['type' => 'private']);
        $key->loadKey($pemKey);
        $dsig->sign($key);

        // Add KeyInfo with X509
        $dsig->add509Cert($pemCert, true, false, ['issuerSerial' => true]);

        // Append the <ds:Signature> to the root
        $root = $doc->documentElement;
        $dsig->appendSignature($root);

        // Assign a stable-looking Id: Signature-<digits>
        $sigNode = $dsig->sigNode;
        if (!$sigNode->hasAttribute('Id')) {
            $sigNode->setAttribute('Id', 'Signature-' . random_int(1000000, 99999999));
        }

        // Attach minimal XAdES QualifyingProperties inside ds:Object
        $this->attachXades($doc, $sigNode, $pemCert);

        return $doc;
    }

    private function loadCredentials(string $privateKeyFile, ?string $certificateFile, ?string $pkcs12Password): array
    {
        $pemCert = null;

        if ($pkcs12Password !== null) {
            $pkcs12 = file_get_contents($privateKeyFile);
            $certs = [];
            if (!openssl_pkcs12_read($pkcs12, $certs, $pkcs12Password)) {
                throw new RuntimeException('Nie udało się odczytać PKCS#12.');
            }
            $pemKey = $certs['pkey'] ?? null;
            $pemCert = $certs['cert'] ?? null;
        } else {
            $pemKey = file_get_contents($privateKeyFile);
            if ($certificateFile !== null) {
                $pemCert = file_get_contents($certificateFile);
            }
        }

        if (!$pemKey) {
            throw new RuntimeException('Brak klucza prywatnego.');
        }
        if (!$pemCert) {
            throw new RuntimeException('Brak certyfikatu X.509.');
        }
        return [$pemKey, $pemCert];
    }

    /**
     * @throws RandomException
     * @throws DOMException
     */
    private function attachXades(DOMDocument $doc, DOMElement $sigNode, string $pemCert): void
    {
        $qualProps = $doc->createElementNS(self::XADES_NS, 'xades:QualifyingProperties');
        $qualProps->setAttribute('Target', '#' . $sigNode->getAttribute('Id'));

        $signedProps = $doc->createElementNS(self::XADES_NS, 'xades:SignedProperties');
        $signedProps->setAttribute('Id', 'SignedProperties-' . bin2hex(random_bytes(6)));

        $ssp = $doc->createElementNS(self::XADES_NS, 'xades:SignedSignatureProperties');
        // SigningTime
        $ssp->appendChild($doc->createElementNS(self::XADES_NS, 'xades:SigningTime', gmdate('c')));

        // SigningCertificate: digest SHA-256 of DER cert + IssuerSerial
        $certDer = $this->pemToDer($pemCert);
        $certDigest = base64_encode(hash('sha256', $certDer, true));

        $sc = $doc->createElementNS(self::XADES_NS, 'xades:SigningCertificate');
        $cert = $doc->createElementNS(self::XADES_NS, 'xades:Cert');
        $certDigestNode = $doc->createElementNS(self::XADES_NS, 'xades:CertDigest');
        $digestMethod = $doc->createElementNS(self::DS_NS, 'ds:DigestMethod');
        $digestMethod->setAttribute('Algorithm', XMLSecurityDSig::SHA256);
        $digestValue = $doc->createElementNS(self::DS_NS, 'ds:DigestValue', $certDigest);
        $certDigestNode->appendChild($digestMethod);
        $certDigestNode->appendChild($digestValue);

        $issuerSerial = $doc->createElementNS(self::XADES_NS, 'xades:IssuerSerial');
        $x = openssl_x509_parse($pemCert);
        $serial = isset($x['serialNumberHex']) ? strtoupper($x['serialNumberHex']) : dechex($x['serialNumber']);
        $issuerName = $this->issuerToRfc2253($x['issuer'] ?? []);
        $issuerSerial->appendChild($doc->createElementNS(self::DS_NS, 'ds:X509IssuerName', $issuerName));
        $issuerSerial->appendChild($doc->createElementNS(self::DS_NS, 'ds:X509SerialNumber', (string)hexdec($serial)));

        $cert->appendChild($certDigestNode);
        $cert->appendChild($issuerSerial);
        $sc->appendChild($cert);
        $ssp->appendChild($sc);

        $signedProps->appendChild($ssp);
        $qualProps->appendChild($signedProps);

        $obj = $doc->createElementNS(self::DS_NS, 'ds:Object');
        $obj->appendChild($qualProps);
        $sigNode->appendChild($obj);
    }

    private function pemToDer(string $pem): string
    {
        $clean = preg_replace('~-----BEGIN CERTIFICATE-----|-----END CERTIFICATE-----|\s+~', '', $pem);
        return base64_decode($clean);
    }

    private function issuerToRfc2253(array $issuer): string
    {
        $order = ['CN', 'O', 'OU', 'C', 'L', 'ST', 'E', 'serialNumber'];
        $parts = [];
        foreach ($order as $k) {
            if (isset($issuer[$k])) {
                $v = is_array($issuer[$k]) ? implode('+', $issuer[$k]) : $issuer[$k];
                $parts[] = $k . '=' . $v;
            }
        }
        foreach ($issuer as $k => $v) {
            if (!in_array($k, $order, true)) {
                $parts[] = $k . '=' . (is_array($v) ? implode('+', $v) : $v);
            }
        }
        return implode(',', $parts);
    }
}
