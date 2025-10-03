<?php

namespace Intermedia\Ksef\Apiv2\Utils;

use DateTimeImmutable;
use DOMDocument;
use DOMException;
use Exception;
use InvalidArgumentException;
use OpenSSLAsymmetricKey;

class XadesSigner
{
    private string $raw = '';
    private array $info = [];
    private OpenSSLAsymmetricKey $privateKey;

    const NAMESPACE_DS = 'http://www.w3.org/2000/09/xmldsig#';
    const NAMESPACE_XADES = 'http://uri.etsi.org/01903/v1.3.2#';

    /**
     * Podpisuje przekazany dokument (enveloped XAdES-BES) przy użyciu:
     *  - pliku PKCS#12 (*.p12/*.pfx), gdy $certificateFile === null
     *  - lub pary: klucz prywatny PEM + certyfikat publiczny PEM
     * @param string $xml
     * @param string $privateKeyFile
     * @param string|null $certificateFile
     * @param string|null $pkcs12Password
     * @return DOMDocument
     * @throws DOMException
     * @throws Exception
     */
    public function sign(string $xml, string $privateKeyFile, ?string $certificateFile = null, ?string $pkcs12Password = null): DOMDocument {
        if(($certificateFile === null ? $this->certFromPkcs12($privateKeyFile, $pkcs12Password ?? '') : $this->certFromPemPair($privateKeyFile, $certificateFile, $pkcs12Password ?? ''))===false)
            throw new Exception('No valid cert file provided.');

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = false;
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($xml);

        $ids = [];
        $digest1 = base64_encode(hash('sha256', $dom->C14N(), true));

        $signature = $dom->createElementNS(self::NAMESPACE_DS, 'ds:Signature');
        $signature->setAttribute('Id', $ids['signature'] = self::guid());

        $dom->firstChild?->appendChild($signature);

        $signedInfo = $dom->createElementNS(self::NAMESPACE_DS, 'ds:SignedInfo');
        $signedInfo->setAttribute('Id', self::guid());

        $signature->appendChild($signedInfo);

        $canonicalizationMethod = $dom->createElementNS(self::NAMESPACE_DS, 'ds:CanonicalizationMethod');
        $canonicalizationMethod->setAttribute('Algorithm', 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315');

        $signedInfo->appendChild($canonicalizationMethod);

        $signatureMethod = $dom->createElementNS(self::NAMESPACE_DS, 'ds:SignatureMethod');
        $signatureMethod->setAttribute('Algorithm', 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256');

        $signedInfo->appendChild($signatureMethod);

        $reference1 = $dom->createElementNS(self::NAMESPACE_DS, 'ds:Reference');
        $reference1->setAttribute('Id', self::guid());
        $reference1->setAttribute('URI', '');

        $signedInfo->appendChild($reference1);

        $transforms = $dom->createElementNS(self::NAMESPACE_DS, 'ds:Transforms');

        $reference1->appendChild($transforms);

        $transform = $dom->createElementNS(self::NAMESPACE_DS, 'ds:Transform');
        $transform->setAttribute('Algorithm', 'http://www.w3.org/2000/09/xmldsig#enveloped-signature');

        $transforms->appendChild($transform);

        $digestMethod = $dom->createElementNS(self::NAMESPACE_DS, 'ds:DigestMethod');
        $digestMethod->setAttribute('Algorithm', 'http://www.w3.org/2001/04/xmlenc#sha256');

        $reference1->appendChild($digestMethod);

        $digestValue = $dom->createElementNS(self::NAMESPACE_DS, 'ds:DigestValue', $digest1);

        $reference1->appendChild($digestValue);

        $reference2 = $dom->createElementNS(self::NAMESPACE_DS, 'ds:Reference');
        $reference2->setAttribute('Id', self::guid());
        $reference2->setAttribute('Type', 'http://uri.etsi.org/01903#SignedProperties');

        $signedInfo->appendChild($reference2);

        $digestMethod2 = $dom->createElementNS(self::NAMESPACE_DS, 'ds:DigestMethod');
        $digestMethod2->setAttribute('Algorithm', 'http://www.w3.org/2001/04/xmlenc#sha256');

        $reference2->appendChild($digestMethod2);

        $signatureValue = $dom->createElementNS(self::NAMESPACE_DS, 'ds:SignatureValue');
        $signatureValue->setAttribute('Id', self::guid());

        $signature->appendChild($signatureValue);

        $keyInfo = $dom->createElementNS(self::NAMESPACE_DS, 'ds:KeyInfo');

        $signature->appendChild($keyInfo);

        $x509data = $dom->createElementNS(self::NAMESPACE_DS, 'ds:X509Data');

        $keyInfo->appendChild($x509data);

        $x509Certificate = $dom->createElementNS(self::NAMESPACE_DS, 'ds:X509Certificate', $this->raw);

        $x509data->appendChild($x509Certificate);

        $object = $dom->createElementNS(self::NAMESPACE_DS, 'ds:Object');

        $signature->appendChild($object);

        $qualifyingProperties = $dom->createElementNS(self::NAMESPACE_XADES, 'xades:QualifyingProperties');
        $qualifyingProperties->setAttribute('Id', self::guid());
        $qualifyingProperties->setAttribute('Target', '#' . $ids['signature']);

        $object->appendChild($qualifyingProperties);

        $signedProperties = $dom->createElementNS(self::NAMESPACE_XADES, 'xades:SignedProperties');
        $signedProperties->setAttribute('Id', $ids['signed_properties'] = self::guid());

        $qualifyingProperties->appendChild($signedProperties);

        $reference2->setAttribute('URI', '#' . $ids['signed_properties']);

        $signedSignatureProperties = $dom->createElementNS(self::NAMESPACE_XADES, 'xades:SignedSignatureProperties');

        $signedProperties->appendChild($signedSignatureProperties);

        $signatureTime = $dom->createElementNS(self::NAMESPACE_XADES, 'xades:SigningTime', (new DateTimeImmutable())->format('Y-m-d\TH:i:sp'));

        $signedSignatureProperties->appendChild($signatureTime);

        $signingCertificate = $dom->createElementNS(self::NAMESPACE_XADES, 'xades:SigningCertificate');

        $signedSignatureProperties->appendChild($signingCertificate);

        $xadesCert = $dom->createElementNS(self::NAMESPACE_XADES, 'xades:Cert');

        $signingCertificate->appendChild($xadesCert);

        $xadesCertDigest = $dom->createElementNS(self::NAMESPACE_XADES, 'xades:CertDigest');

        $xadesCert->appendChild($xadesCertDigest);

        $digestMethod3 = $dom->createElementNS(self::NAMESPACE_DS, 'ds:DigestMethod');
        $digestMethod3->setAttribute('Algorithm', 'http://www.w3.org/2001/04/xmlenc#sha256');

        $xadesCertDigest->appendChild($digestMethod3);

        $digestValue = $dom->createElementNS(self::NAMESPACE_DS, 'ds:DigestValue', $this->getFingerPrint());

        $xadesCertDigest->appendChild($digestValue);

        $xadesIssuerSerial = $dom->createElementNS(self::NAMESPACE_XADES, 'xades:IssuerSerial');

        $xadesCert->appendChild($xadesIssuerSerial);

        $x509IssuerName = $dom->createElementNS(self::NAMESPACE_DS, 'ds:X509IssuerName', $this->getIssuer());

        $xadesIssuerSerial->appendChild($x509IssuerName);

        $x509SerialNumber = $dom->createElementNS(self::NAMESPACE_DS, 'ds:X509SerialNumber', $this->getSerialNumber());

        $xadesIssuerSerial->appendChild($x509SerialNumber);

        $xmlDigest = base64_encode(hash('sha256', $signedProperties->C14N(), true));

        $digestValue = $dom->createElementNS(self::NAMESPACE_DS, 'DigestValue', $xmlDigest);
        $digestValue->setAttribute('xmlns', 'http://www.w3.org/2000/09/xmldsig#');

        $reference2->appendChild($digestValue);

        $currentDigest = '';

        if(openssl_sign($signedInfo->C14N(),$currentDigest, $this->privateKey,'sha256WithRSAEncryption')===false)
            throw new Exception('Problem with signing an XML document.');

        $signatureValue->textContent = base64_encode($currentDigest);

        return $dom;
    }

    // --- helpers ---

    /**
     * @return string
     */
    private static function guid(): string
    {
        mt_srand((int)(microtime(true) * 10000));
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        return 'ID-' .substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);
    }

    /**
     * @param string $path
     * @param string $password
     * @return bool
     * @throws Exception
     */
    private function certFromPkcs12(string $path, string $password = ''): bool
    {
        $certs = [];
        if(($pkcs12 = @file_get_contents($path)) === false)
            throw new Exception('Unable to open cert file');

        if((openssl_pkcs12_read($pkcs12, $certs, $password)) === false)
            throw new Exception(sprintf("Can't read a p12 file. OpenSSL: %s", (openssl_error_string() ?: '')));

        if(($this->privateKey = openssl_pkey_get_private($certs['pkey'], $password)) === false)
            throw new Exception(sprintf("Can't read a private key. OpenSSL: %s", (openssl_error_string() ?: '')));

        if(($this->info = openssl_x509_parse($certs['cert'])) === false)
            throw new Exception(sprintf('Unable to parse a cert. OpenSSL: %s', (openssl_error_string() ?: '')));

        $this->raw = trim(str_replace(['-----BEGIN CERTIFICATE-----', '-----END CERTIFICATE-----', "\n"],'', $certs['cert']));

        return true;
    }

    /**
     * @param string $privateKeyFile
     * @param string $certificateFile
     * @param string $password
     * @return bool
     * @throws Exception
     */
    private function certFromPemPair(string $privateKeyFile, string $certificateFile, string $password = ''): bool
    {
        if(($pkeyPem = @file_get_contents($privateKeyFile)) === false)
            throw new Exception('Unable to open private key file');

        if(($certPem = @file_get_contents($certificateFile)) === false)
            throw new Exception('Unable to open cert file');

        if(($this->privateKey = openssl_pkey_get_private($pkeyPem, $password)) === false)
            throw new Exception(sprintf("Can't read a private key. OpenSSL: %s", (openssl_error_string() ?: '')));

        $this->raw = trim(str_replace(['-----BEGIN CERTIFICATE-----', '-----END CERTIFICATE-----', "\n", "\r"],'',$certPem));

        if(($this->info = openssl_x509_parse($certPem)) === false)
            throw new Exception(sprintf('Unable to parse a cert. OpenSSL: %s', (openssl_error_string() ?: '')));

        return true;
    }

    /**
     * @return string
     */
    private function getFingerPrint(): string
    {
        return base64_encode(hash('sha256', base64_decode($this->raw), true));
    }

    /**
     * @return string
     */
    private function getSerialNumber(): string
    {
        return $this->hexdecBig($this->info['serialNumberHex']);
    }

    /**
     * @return string
     */
    private function getIssuer(): string
    {
        $issuer = [];
        foreach ($this->info['issuer'] as $key => $value) {
            $issuer[] = $key . '=' . $value;
        }
        return implode(', ', array_reverse($issuer));
    }

    /**
     * @param string $hex
     * @return string
     */
    private function hexdecBig(string $hex): string
    {
        $hex = strtolower($hex);
        if (str_starts_with($hex, "0x")) {
            $hex = substr($hex, 2);
        }

        $dec = '0';
        $len = strlen($hex);
        for ($i = 0; $i < $len; $i++) {
            $current = strpos('0123456789abcdef', $hex[$i]);
            if ($current === false) {
                throw new InvalidArgumentException("Invalid hex string: $hex");
            }
            $dec = bcmul($dec, '16');
            $dec = bcadd($dec, (string)$current);
        }

        return $dec;
    }
}
