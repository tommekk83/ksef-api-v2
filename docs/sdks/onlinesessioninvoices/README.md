# OnlineSessionInvoices
(*onlineSessionInvoices*)

## Overview

### Available Operations

* [send](#send) - Wysłanie faktury

## send

Przyjmuje zaszyfrowaną fakturę oraz jej metadane i rozpoczyna jej przetwarzanie.

> Więcej informacji:
> - [Wysłanie faktury](https://github.com/CIRFMF/ksef-docs/blob/main/sesja-interaktywna.md#2-wys%C5%82anie-faktury)

Wymagane uprawnienia: `InvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/sessions/online/{referenceNumber}/invoices" method="post" path="/api/v2/sessions/online/{referenceNumber}/invoices" -->
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

$requestBody = new Operations\PostApiV2SessionsOnlineReferenceNumberInvoicesRequestBody(
    invoiceHash: 'EbrK4cOSjW4hEpJaHU71YXSOZZmqP5++dK9nLgTzgV4=',
    invoiceSize: 6480,
    encryptedInvoiceHash: 'miYb1z3Ljw5VucTZslv3Tlt+V/EK1V8Q8evD8HMQ0dc=',
    encryptedInvoiceSize: 6496,
    encryptedInvoiceContent: '<value>',
);

$response = $sdk->onlineSessionInvoices->send(
    referenceNumber: '<value>',
    requestBody: $requestBody

);

if ($response->sendInvoiceResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                     | Type                                                                                                                                                          | Required                                                                                                                                                      | Description                                                                                                                                                   |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `referenceNumber`                                                                                                                                             | *string*                                                                                                                                                      | :heavy_check_mark:                                                                                                                                            | Numer referencyjny sesji                                                                                                                                      |
| `requestBody`                                                                                                                                                 | [?Operations\PostApiV2SessionsOnlineReferenceNumberInvoicesRequestBody](../../Models/Operations/PostApiV2SessionsOnlineReferenceNumberInvoicesRequestBody.md) | :heavy_minus_sign:                                                                                                                                            | Dane faktury                                                                                                                                                  |

### Response

**[?Operations\PostApiV2SessionsOnlineReferenceNumberInvoicesResponse](../../Models/Operations/PostApiV2SessionsOnlineReferenceNumberInvoicesResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |