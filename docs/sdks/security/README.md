# Security

## Overview

### Available Operations

* [getPublicKeyCertificates](#getpublickeycertificates) - Pobranie certyfikatów

## getPublicKeyCertificates

Zwraca informacje o kluczach publicznych używanych do szyfrowania danych przesyłanych do systemu KSeF.

### Example Usage

<!-- UsageSnippet language="php" operationID="getPublicKeyCertificates" method="get" path="/security/public-key-certificates" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->security->getPublicKeyCertificates(

);

if ($response->publicKeyCertificates !== null) {
    // handle response
}
```

### Response

**[?Operations\GetPublicKeyCertificatesResponse](../../Models/Operations/GetPublicKeyCertificatesResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |