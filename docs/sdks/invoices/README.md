# Invoices
(*invoices*)

## Overview

### Available Operations

* [getList](#getlist) - Pobranie faktur sesji
* [getInvoiceStatus](#getinvoicestatus) - Pobranie statusu faktury z sesji
* [getFailed](#getfailed) - Pobranie niepoprawnie przetworzonych faktur sesji
* [getInvoiceUpoByKsefNumber](#getinvoiceupobyksefnumber) - Pobranie UPO faktury z sesji na podstawie numeru KSeF
* [getUpo](#getupo) - Pobranie UPO faktury z sesji na podstawie numeru referencyjnego faktury
* [sendOnline](#sendonline) - Wysłanie faktury

## getList

Zwraca listę faktur przesłanych w sesji wraz z ich statusami, oraz informacje na temat ilości poprawnie i niepoprawnie przetworzonych faktur.

Wymagane uprawnienia: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

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



$response = $sdk->invoices->getList(
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

## getInvoiceStatus

Zwraca fakturę przesłaną w sesji wraz ze statusem.

Wymagane uprawnienia: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

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



$response = $sdk->invoices->getInvoiceStatus(
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

## getFailed

Zwraca listę niepoprawnie przetworzonych faktur przesłanych w sesji wraz z ich statusami.

Wymagane uprawnienia: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/sessions/{referenceNumber}/invoices/failed" method="get" path="/api/v2/sessions/{referenceNumber}/invoices/failed" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->invoices->getFailed(
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

**[?Operations\GetApiV2SessionsReferenceNumberInvoicesFailedResponse](../../Models/Operations/GetApiV2SessionsReferenceNumberInvoicesFailedResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getInvoiceUpoByKsefNumber

Zwraca UPO faktury przesłanego w sesji na podstawie jego numeru KSeF.

Wymagane uprawnienia: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/sessions/{referenceNumber}/invoices/ksef/{ksefNumber}/upo" method="get" path="/api/v2/sessions/{referenceNumber}/invoices/ksef/{ksefNumber}/upo" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->invoices->getInvoiceUpoByKsefNumber(
    referenceNumber: '<value>',
    ksefNumber: '<value>'

);

if ($response->res !== null) {
    // handle response
}
```

### Parameters

| Parameter                 | Type                      | Required                  | Description               |
| ------------------------- | ------------------------- | ------------------------- | ------------------------- |
| `referenceNumber`         | *string*                  | :heavy_check_mark:        | Numer referencyjny sesji. |
| `ksefNumber`              | *string*                  | :heavy_check_mark:        | Numer KSeF faktury.       |

### Response

**[?Operations\GetApiV2SessionsReferenceNumberInvoicesKsefKsefNumberUpoResponse](../../Models/Operations/GetApiV2SessionsReferenceNumberInvoicesKsefKsefNumberUpoResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getUpo

Zwraca UPO faktury przesłanego w sesji na podstawie jego numeru KSeF.

Wymagane uprawnienia: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/sessions/{referenceNumber}/invoices/{invoiceReferenceNumber}/upo" method="get" path="/api/v2/sessions/{referenceNumber}/invoices/{invoiceReferenceNumber}/upo" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->invoices->getUpo(
    referenceNumber: '<value>',
    invoiceReferenceNumber: '<value>'

);

if ($response->res !== null) {
    // handle response
}
```

### Parameters

| Parameter                   | Type                        | Required                    | Description                 |
| --------------------------- | --------------------------- | --------------------------- | --------------------------- |
| `referenceNumber`           | *string*                    | :heavy_check_mark:          | Numer referencyjny sesji.   |
| `invoiceReferenceNumber`    | *string*                    | :heavy_check_mark:          | Numer referencyjny faktury. |

### Response

**[?Operations\GetApiV2SessionsReferenceNumberInvoicesInvoiceReferenceNumberUpoResponse](../../Models/Operations/GetApiV2SessionsReferenceNumberInvoicesInvoiceReferenceNumberUpoResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## sendOnline

Przyjmuje zaszyfrowaną fakturę oraz jej metadane i rozpoczyna jej przetwarzanie.

> Więcej informacji:
> - [Wysłanie faktury](https://github.com/CIRFMF/ksef-docs/blob/main/sesja-interaktywna.md#2-wys%C5%82anie-faktury)

Wymagane uprawnienia: `InvoiceWrite`, `PefInvoiceWrite`.

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

$response = $sdk->invoices->sendOnline(
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