# Invoices
(*invoices*)

## Overview

### Available Operations

* [getByKsefNumber](#getbyksefnumber) - Pobranie faktury po numerze KSeF
* [getList](#getlist) - Pobranie listy metadanych faktur
* [export](#export) - Eksport paczki faktur
* [getExportStatus](#getexportstatus) - Pobranie statusu eksportu paczki faktur

## getByKsefNumber

Zwraca fakturę o podanym numerze KSeF.

Wymagane uprawnienia: `InvoiceRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="getByKsefNumber" method="get" path="/api/v2/invoices/ksef/{ksefNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->invoices->getByKsefNumber(
    ksefNumber: '<value>'
);

if ($response->res !== null) {
    // handle response
}
```

### Parameters

| Parameter           | Type                | Required            | Description         |
| ------------------- | ------------------- | ------------------- | ------------------- |
| `ksefNumber`        | *string*            | :heavy_check_mark:  | Numer KSeF faktury. |

### Response

**[?Operations\GetByKsefNumberResponse](../../Models/Operations/GetByKsefNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getList

Zwraca listę metadanych faktur spełniające podane kryteria wyszukiwania. Wyniki sortowane są rosnąco według typu daty przekazanej w `DateRange`. Do realizacji pobierania przyrostowego należy stosować typ `PermanentStorage`. Maksymalnie można pobrać faktury w zakresie do 10 000 rekordów

Wymagane uprawnienia: `InvoiceRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="getInvoicesList" method="post" path="/api/v2/invoices/query/metadata" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;
use Intermedia\Ksef\Apiv2\Models\Components;
use Intermedia\Ksef\Apiv2\Models\Operations;
use Intermedia\Ksef\Apiv2\Utils;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$requestBody = new Operations\GetInvoicesListRequestBody(
    subjectType: Components\InvoiceQuerySubjectType::Subject1,
    dateRange: new Operations\GetInvoicesListDateRange(
        dateType: Components\InvoiceQueryDateType::PermanentStorage,
        from: Utils\Utils::parseDateTime('2025-08-28T09:22:13.388+00:00'),
        to: Utils\Utils::parseDateTime('2025-09-28T09:22:13.388+00:00'),
    ),
    amount: new Operations\GetInvoicesListAmount(
        type: Components\AmountType::Brutto,
        from: 100.5,
        to: 250,
    ),
    currencyCodes: [
        Components\CurrencyCode::Pln,
        Components\CurrencyCode::Eur,
    ],
    invoicingMode: Operations\GetInvoicesListInvoicingMode::Online,
    formType: Operations\GetInvoicesListFormType::Fa,
    invoiceTypes: [
        Components\InvoiceType::Vat,
    ],
    hasAttachment: true,
);

$response = $sdk->invoices->getList(
    pageOffset: 0,
    pageSize: 10,
    requestBody: $requestBody

);

if ($response->queryInvoicesMetadataResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                       | Type                                                                                            | Required                                                                                        | Description                                                                                     |
| ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                    | *?int*                                                                                          | :heavy_minus_sign:                                                                              | Indeks pierwszej strony wyników (0 = pierwsza strona).                                          |
| `pageSize`                                                                                      | *?int*                                                                                          | :heavy_minus_sign:                                                                              | Rozmiar strony wyników.                                                                         |
| `requestBody`                                                                                   | [?Operations\GetInvoicesListRequestBody](../../Models/Operations/GetInvoicesListRequestBody.md) | :heavy_minus_sign:                                                                              | Zestaw filtrów dla wyszukiwania metadanych.                                                     |

### Response

**[?Operations\GetInvoicesListResponse](../../Models/Operations/GetInvoicesListResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## export

Rozpoczyna asynchroniczny proces wyszukiwania faktur w systemie KSeF na podstawie przekazanych filtrów oraz przygotowania ich w formie zaszyfrowanej paczki.
Wymagane jest przekazanie informacji o szyfrowaniu w polu `Encryption`, które służą do zabezpieczenia przygotowanej paczki z fakturami.

Wymagane uprawnienia: `InvoiceRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="export" method="post" path="/api/v2/invoices/exports" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->invoices->export(
    request: $request
);

if ($response->exportInvoicesResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                            | Type                                                                 | Required                                                             | Description                                                          |
| -------------------------------------------------------------------- | -------------------------------------------------------------------- | -------------------------------------------------------------------- | -------------------------------------------------------------------- |
| `$request`                                                           | [Operations\ExportRequest](../../Models/Operations/ExportRequest.md) | :heavy_check_mark:                                                   | The request object to use for the request.                           |

### Response

**[?Operations\ExportResponse](../../Models/Operations/ExportResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getExportStatus


Wymagane uprawnienia: `InvoiceRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="getExportStatus" method="get" path="/api/v2/invoices/exports/{operationReferenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->invoices->getExportStatus(
    operationReferenceNumber: '<value>'
);

if ($response->invoiceExportStatusResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                    | Type                         | Required                     | Description                  |
| ---------------------------- | ---------------------------- | ---------------------------- | ---------------------------- |
| `operationReferenceNumber`   | *string*                     | :heavy_check_mark:           | Numer referencyjny operacji. |

### Response

**[?Operations\GetExportStatusResponse](../../Models/Operations/GetExportStatusResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |