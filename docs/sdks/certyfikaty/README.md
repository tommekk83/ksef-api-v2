# Certyfikaty
(*certyfikaty*)

## Overview

Certyfikat KSeF to cyfrowe poświadczenie tożsamości podmiotu, wydawane przez system KSeF na wniosek uwierzytelnionego podmiotu. 
Certyfikat ten może być wykorzystywany do:

- uwierzytelniania się w systemie KSeF,
- realizacji operacji w trybie offline, w tym wystawiania faktur bezpośrednio w aplikacji użytkownika.

**Uwaga**: Wnioskowanie o certyfikat KSeF jest możliwe wyłącznie po uwierzytelnieniu z wykorzystaniem podpisu (XAdES). Uwierzytelnienie przy użyciu tokenu systemowego KSeF nie pozwala na złożenie wniosku.

### Available Operations

* [retrieve](#retrieve) - Pobranie certyfikatu lub listy certyfikatów

## retrieve

Zwraca certyfikaty o podanych numerach seryjnych w formacie DER zakodowanym w Base64.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/certificates/retrieve" method="post" path="/api/v2/certificates/retrieve" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;
use Intermedia\Ksef\Apiv2\Models\Operations;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$request = new Operations\PostApiV2CertificatesRetrieveRequest(
    certificateSerialNumbers: [
        '0321C82DA41B4362',
        '0321F21DA462A362',
    ],
);

$response = $sdk->certyfikaty->retrieve(
    request: $request
);

if ($response->retrieveCertificatesResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                          | Type                                                                                                               | Required                                                                                                           | Description                                                                                                        |
| ------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------ |
| `$request`                                                                                                         | [Operations\PostApiV2CertificatesRetrieveRequest](../../Models/Operations/PostApiV2CertificatesRetrieveRequest.md) | :heavy_check_mark:                                                                                                 | The request object to use for the request.                                                                         |

### Response

**[?Operations\PostApiV2CertificatesRetrieveResponse](../../Models/Operations/PostApiV2CertificatesRetrieveResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |