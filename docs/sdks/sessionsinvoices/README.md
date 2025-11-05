# SessionsInvoices
(*sessions->invoices*)

## Overview

### Available Operations

* [getList](#getlist) - Pobranie faktur sesji
* [getStatus](#getstatus) - Pobranie statusu faktury z sesji
* [getFailed](#getfailed) - Pobranie niepoprawnie przetworzonych faktur sesji
* [getInvoiceUpoByKsefNumber](#getinvoiceupobyksefnumber) - Pobranie UPO faktury z sesji na podstawie numeru KSeF
* [getUpo](#getupo) - Pobranie UPO faktury z sesji na podstawie numeru referencyjnego faktury
* [sendOnline](#sendonline) - Wysłanie faktury

## getList

Zwraca listę faktur przesłanych w sesji wraz z ich statusami, oraz informacje na temat ilości poprawnie i niepoprawnie przetworzonych faktur.

**Wymagane uprawnienia**: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="getSessionInvoicesList" method="get" path="/api/v2/sessions/{referenceNumber}/invoices" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessions->invoices->getList(
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

**[?Operations\GetSessionInvoicesListResponse](../../Models/Operations/GetSessionInvoicesListResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getStatus

Zwraca fakturę przesłaną w sesji wraz ze statusem.

**Wymagane uprawnienia**: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="getInvoiceStatus" method="get" path="/api/v2/sessions/{referenceNumber}/invoices/{invoiceReferenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessions->invoices->getStatus(
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

**[?Operations\GetInvoiceStatusResponse](../../Models/Operations/GetInvoiceStatusResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getFailed

Zwraca listę niepoprawnie przetworzonych faktur przesłanych w sesji wraz z ich statusami.

**Wymagane uprawnienia**: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="getFailedInvoices" method="get" path="/api/v2/sessions/{referenceNumber}/invoices/failed" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessions->invoices->getFailed(
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

**[?Operations\GetFailedInvoicesResponse](../../Models/Operations/GetFailedInvoicesResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getInvoiceUpoByKsefNumber

Zwraca UPO faktury przesłanego w sesji na podstawie jego numeru KSeF.

**Wymagane uprawnienia**: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="getUpoByKsefNumber" method="get" path="/api/v2/sessions/{referenceNumber}/invoices/ksef/{ksefNumber}/upo" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessions->invoices->getInvoiceUpoByKsefNumber(
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

**[?Operations\GetUpoByKsefNumberResponse](../../Models/Operations/GetUpoByKsefNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getUpo

Zwraca UPO faktury przesłanego w sesji na podstawie jego numeru KSeF.

**Wymagane uprawnienia**: `InvoiceWrite`, `Introspection`, `PefInvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="getInvoiceUpo" method="get" path="/api/v2/sessions/{referenceNumber}/invoices/{invoiceReferenceNumber}/upo" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessions->invoices->getUpo(
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

**[?Operations\GetInvoiceUpoResponse](../../Models/Operations/GetInvoiceUpoResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## sendOnline

Przyjmuje zaszyfrowaną fakturę oraz jej metadane i rozpoczyna jej przetwarzanie.

> Więcej informacji:
> - [Wysłanie faktury](https://github.com/CIRFMF/ksef-docs/blob/main/sesja-interaktywna.md#2-wys%C5%82anie-faktury)

**Wymagane uprawnienia**: `InvoiceWrite`, `PefInvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="sendOnline" method="post" path="/api/v2/sessions/online/{referenceNumber}/invoices" -->
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

$requestBody = new Operations\SendOnlineRequestBody(
    invoiceHash: 'EbrK4cOSjW4hEpJaHU71YXSOZZmqP5++dK9nLgTzgV4=',
    invoiceSize: 6480,
    encryptedInvoiceHash: 'miYb1z3Ljw5VucTZslv3Tlt+V/EK1V8Q8evD8HMQ0dc=',
    encryptedInvoiceSize: 6496,
    encryptedInvoiceContent: '<value>',
);

$response = $sdk->sessions->invoices->sendOnline(
    referenceNumber: '<value>',
    requestBody: $requestBody

);

if ($response->sendInvoiceResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                             | Type                                                                                  | Required                                                                              | Description                                                                           |
| ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- |
| `referenceNumber`                                                                     | *string*                                                                              | :heavy_check_mark:                                                                    | Numer referencyjny sesji                                                              |
| `requestBody`                                                                         | [?Operations\SendOnlineRequestBody](../../Models/Operations/SendOnlineRequestBody.md) | :heavy_minus_sign:                                                                    | Dane faktury                                                                          |

### Response

**[?Operations\SendOnlineResponse](../../Models/Operations/SendOnlineResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |