# SessionInvoices
(*sessionInvoices*)

## Overview

### Available Operations

* [list](#list) - Pobranie faktur sesji
* [getStatus](#getstatus) - Pobranie statusu faktury z sesji

## list

Zwraca listę faktur przesłanych w sesji wraz z ich statusami, oraz informacje na temat ilości poprawnie i niepoprawnie przetworzonych faktur.

Wymagane uprawnienia: `InvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/sessions/{referenceNumber}/invoices" method="get" path="/api/v2/sessions/{referenceNumber}/invoices" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessionInvoices->list(
    referenceNumber: '<value>',
    pageSize: 10

);

if ($response->sessionInvoicesResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                          | Type                                               | Required                                           | Description                                        |
| -------------------------------------------------- | -------------------------------------------------- | -------------------------------------------------- | -------------------------------------------------- |
| `referenceNumber`                                  | *string*                                           | :heavy_check_mark:                                 | Numer referencyjny sesji.                          |
| `xContinuationToken`                               | *?string*                                          | :heavy_minus_sign:                                 | Token służący do pobrania kolejnej strony wyników. |
| `pageSize`                                         | *?int*                                             | :heavy_minus_sign:                                 | Rozmiar strony wyników.                            |

### Response

**[?Operations\GetApiV2SessionsReferenceNumberInvoicesResponse](../../Models/Operations/GetApiV2SessionsReferenceNumberInvoicesResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getStatus

Zwraca fakturę przesłaną w sesji wraz ze statusem.

Wymagane uprawnienia: `InvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/sessions/{referenceNumber}/invoices/{invoiceReferenceNumber}" method="get" path="/api/v2/sessions/{referenceNumber}/invoices/{invoiceReferenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessionInvoices->getStatus(
    referenceNumber: '<value>',
    invoiceReferenceNumber: '<value>'

);

if ($response->sessionInvoiceStatusResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                   | Type                        | Required                    | Description                 |
| --------------------------- | --------------------------- | --------------------------- | --------------------------- |
| `referenceNumber`           | *string*                    | :heavy_check_mark:          | Numer referencyjny sesji.   |
| `invoiceReferenceNumber`    | *string*                    | :heavy_check_mark:          | Numer referencyjny faktury. |

### Response

**[?Operations\GetApiV2SessionsReferenceNumberInvoicesInvoiceReferenceNumberResponse](../../Models/Operations/GetApiV2SessionsReferenceNumberInvoicesInvoiceReferenceNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |