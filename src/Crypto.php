<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2;

use Random\RandomException;
use RuntimeException;
use phpseclib3\Crypt\RSA;
use phpseclib3\Crypt\PublicKeyLoader;

final class Crypto
{
    private RSA\PublicKey $mfPublicKey;

    /**
     * @param string $mfPublicKeyPem Publiczny klucz KSeF (PEM: -----BEGIN PUBLIC KEY----- ...).
     */
    public function __construct(string $mfPublicKeyPem)
    {
        if (trim($mfPublicKeyPem) === '') {
            throw new RuntimeException('Pusty PEM z kluczem publicznym MF.');
        }

        // Wczytanie + konfiguracja OAEP: MGF1/SHA-256 i SHA-256
        $this->mfPublicKey = PublicKeyLoader::load($mfPublicKeyPem)
            ->withPadding(RSA::ENCRYPTION_OAEP)
            ->withHash('sha256')
            ->withMGFHash('sha256');
    }

    /**
     * Generuje klucz AES-256 (32B) i IV 128-bit (16B).
     * @return array{key: string, iv: string} surowe bajty (binarne)
     * @throws RandomException
     */
    public function generateSymetricKey(): array
    {
        return [
            'key' => random_bytes(32), // 256-bit
            'iv'  => random_bytes(16), // 128-bit
        ];
    }

    /**
     * Szyfrowanie klucza symetrycznego RSAES-OAEP (MGF1/SHA-256, SHA-256).
     * Zwraca Base64.
     *
     * @param string $symmetricKey surowe 32 bajty
     */
    public function encryptSymmetricKeyB64(string $symmetricKey): string
    {
        if (strlen($symmetricKey) !== 32) {
            throw new RuntimeException('Klucz symetryczny musi mieć dokładnie 32 bajty (AES-256).');
        }
        $encrypted = $this->mfPublicKey->encrypt($symmetricKey);
        if ($encrypted === false) {
            throw new RuntimeException('Błąd szyfrowania RSA OAEP.');
        }
        return base64_encode($encrypted);
    }

    /**
     * Szyfruje treść XML algorytmem AES-256-CBC (PKCS#7), prefiksując IV.
     * Zwraca Base64( IV || ciphertext ).
     *
     * @param string $xml          zawartość XML jako string
     * @param string $symmetricKey 32 bajty
     * @param string $iv           16 bajtów
     */
    public function encryptXmlPayloadB64(string $xml, string $symmetricKey, string $iv): string
    {
        if (strlen($symmetricKey) !== 32) {
            throw new RuntimeException('Klucz symetryczny musi mieć 32 bajty (AES-256).');
        }
        if (strlen($iv) !== 16) {
            throw new RuntimeException('IV musi mieć 16 bajtów (128-bit).');
        }

        $ciphertextRaw = openssl_encrypt(
            $xml,
            'aes-256-cbc',
            $symmetricKey,
            OPENSSL_RAW_DATA, // potrzebujemy surowych bajtów
            $iv
        );

        if ($ciphertextRaw === false) {
            throw new RuntimeException('Błąd podczas szyfrowania XML AES-256-CBC.');
        }

        // KSeF: IV jako prefiks do szyfrogramu, potem Base64
        return base64_encode($iv . $ciphertextRaw);
    }

    /**
     * Wygodny „pakiet” pod KSeF:
     *  - generuje nowy klucz/IV,
     *  - szyfruje klucz RSA OAEP (B64),
     *
     * @return array{
     *   encryptedSymmetricKeyB64: string,
     *   key: string,
     *   iv: string
     * }
     * @throws RandomException
     */
    public function buildEncryptedPackage(): array
    {
        $session = $this->generateSymetricKey();

        return [
            'encryptedSymmetricKeyB64' => $this->encryptSymmetricKeyB64($session['key']),
            'ivB64'  => base64_encode($session['iv']),
            'key' => $session['key'],
            'iv'  => $session['iv'],
        ];
    }
}