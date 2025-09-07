<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2;

use DOMDocument;
use DOMException;
use Exception;
use Intermedia\Ksef\Apiv2\Models\Components\TContextIdentifier;
use Intermedia\Ksef\Apiv2\Models\Components\SubjectIdentifierTypeEnum;
use Intermedia\Ksef\Apiv2\Models\Components\IpAddressPolicy;
use Intermedia\Ksef\Apiv2\Utils\XadesSigner;
use InvalidArgumentException;

final class AuthTokenRequest
{
    private string $challenge;
    private TContextIdentifier $contextIdentifier;
    private SubjectIdentifierTypeEnum $subjectIdentifierType;
    private ?IpAddressPolicy $ipAddressPolicy;

    public function __construct(string $challenge, TContextIdentifier $contextIdentifier, SubjectIdentifierTypeEnum $subjectIdentifierType, ?IpAddressPolicy $ipAddressPolicy = null)
    {
        $len = mb_strlen($challenge);
        if ($len !== 36) {
            throw new InvalidArgumentException('Challenge must be length 36');
        }
        if (!preg_match('~^\d{8}-CR-[A-F0-9]{10}-[A-F0-9]{10}-[A-F0-9]{2}$~u', $challenge)) {
            throw new InvalidArgumentException('Challenge does not match required pattern');
        }
        $this->challenge = $challenge;
        $this->contextIdentifier = $contextIdentifier;
        $this->subjectIdentifierType = $subjectIdentifierType;
        $this->ipAddressPolicy = $ipAddressPolicy;
    }

    /**
     * @throws DOMException
     */
    public function toXml(?DOMDocument $doc = null): DOMDocument
    {
        $doc = $doc ?: new DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;
        $root = $doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'AuthTokenRequest');
        $doc->appendChild($root);
        $root->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $root->setAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');

        $root->appendChild($doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'Challenge', $this->challenge));

        $ctx = $doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'ContextIdentifier');
        if ($this->contextIdentifier->getNip() !== null) {
            $ctx->appendChild($doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'Nip', (string)$this->contextIdentifier->getNip()));
        } elseif ($this->contextIdentifier->getInternalId() !== null) {
            $ctx->appendChild($doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'InternalId', (string)$this->contextIdentifier->getInternalId()));
        } else {
            $ctx->appendChild($doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'NipVatUe', (string)$this->contextIdentifier->getNipVatUe()));
        }
        $root->appendChild($ctx);

        $root->appendChild($doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'SubjectIdentifierType', $this->subjectIdentifierType->value));

        if ($this->ipAddressPolicy) {
            $pol = $doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'IpAddressPolicy');
            if ($this->ipAddressPolicy->getOnClientIpChange()) {
                $pol->appendChild($doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'OnClientIpChange', $this->ipAddressPolicy->getOnClientIpChange()->value));
            }
            $allowedObj = $this->ipAddressPolicy->getAllowedIps();
            if ($allowedObj) {
                $hasAny = count($allowedObj->getIpAddress()) || count($allowedObj->getIpRange()) || count($allowedObj->getIpMask());
                if ($hasAny) {
                    $allowed = $doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'AllowedIps');
                    foreach ($allowedObj->getIpAddress() as $ip) {
                        $allowed->appendChild($doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'IpAddress', $ip));
                    }
                    foreach ($allowedObj->getIpRange() as $r) {
                        $allowed->appendChild($doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'IpRange', $r));
                    }
                    foreach ($allowedObj->getIpMask() as $m) {
                        $allowed->appendChild($doc->createElementNS('http://ksef.mf.gov.pl/auth/token/2.0', 'IpMask', $m));
                    }
                    $pol->appendChild($allowed);
                }
            }
            $root->appendChild($pol);
        }

        return $doc;
    }

    /**
     * @throws DOMException
     */
    public function toXmlString(): string
    {
        return $this->toXml()->saveXML();
    }

    /**
     * @throws DOMException
     * @throws Exception
     */
    public function signWithXades(string $privateKeyFile, ?string $certificateFile = null, ?string $pkcs12Password = null): DOMDocument
    {
        $doc = $this->toXml();
        $signer = new XadesSigner();
        return $signer->sign($doc, $privateKeyFile, $certificateFile, $pkcs12Password);
    }

    /**
     * @throws DOMException
     */
    public function signWithXadesToString(string $privateKeyFile, ?string $certificateFile = null, ?string $pkcs12Password = null): string
    {
        return $this->signWithXades($privateKeyFile, $certificateFile, $pkcs12Password)->saveXML();
    }
}
