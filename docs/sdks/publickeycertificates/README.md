# PublicKeyCertificates
(*publicKeyCertificates*)

## Overview

### Available Operations

* [get](#get) - Pobranie certyfikatów

## get

Zwraca informacje o kluczach publicznych używanych do szyfrowania danych przesyłanych do systemu KSeF.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/security/public-key-certificates" method="get" path="/api/v2/security/public-key-certificates" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->publicKeyCertificates->get(

);

if ($response->publicKeyCertificates !== null) {
    // handle response
}
```

### Response

**[?Operations\GetApiV2SecurityPublicKeyCertificatesResponse](../../Models/Operations/GetApiV2SecurityPublicKeyCertificatesResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |