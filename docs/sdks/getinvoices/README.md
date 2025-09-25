# GetInvoices
(*getInvoices*)

## Overview

### Available Operations

* [getByKsefNumber](#getbyksefnumber) - Pobranie faktury po numerze KSeF
* [get](#get) - Pobranie listy metadanych faktur
* [export](#export) - Eksport paczki faktur
* [getExportStatus](#getexportstatus) - Pobranie statusu eksportu paczki faktur

## getByKsefNumber

Zwraca fakturę o podanym numerze KSeF.

Wymagane uprawnienia: `InvoiceRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/invoices/ksef/{ksefNumber}" method="get" path="/api/v2/invoices/ksef/{ksefNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->getInvoices->getByKsefNumber(
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

**[?Operations\GetApiV2InvoicesKsefKsefNumberResponse](../../Models/Operations/GetApiV2InvoicesKsefKsefNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## get

Zwraca listę metadanych faktur spełniające podane kryteria wyszukiwania. Wyniki sortowane są rosnąco według typu daty przekazanej w `DateRange`. Do realizacji pobierania przyrostowego należy stosować typ `PermanentStorage`. Maksymalnie można pobrać faktury w zakresie do 10 000 rekordów

Wymagane uprawnienia: `InvoiceRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/invoices/query/metadata" method="post" path="/api/v2/invoices/query/metadata" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->getInvoices->get(
    pageOffset: 0,
    pageSize: 10,
    requestBody: $requestBody

);

if ($response->queryInvoicesMetadataResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                     | Type                                                                                                                          | Required                                                                                                                      | Description                                                                                                                   |
| ----------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                                                  | *?int*                                                                                                                        | :heavy_minus_sign:                                                                                                            | Indeks pierwszej strony wyników (0 = pierwsza strona).                                                                        |
| `pageSize`                                                                                                                    | *?int*                                                                                                                        | :heavy_minus_sign:                                                                                                            | Rozmiar strony wyników. Wartość musi zawierać się w przedziale od 10 do 250.                                                  |
| `requestBody`                                                                                                                 | [?Operations\PostApiV2InvoicesQueryMetadataRequestBody](../../Models/Operations/PostApiV2InvoicesQueryMetadataRequestBody.md) | :heavy_minus_sign:                                                                                                            | Zestaw filtrów dla wyszukiwania metadanych.                                                                                   |

### Response

**[?Operations\PostApiV2InvoicesQueryMetadataResponse](../../Models/Operations/PostApiV2InvoicesQueryMetadataResponse.md)**

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

<!-- UsageSnippet language="php" operationID="post_/api/v2/invoices/exports" method="post" path="/api/v2/invoices/exports" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->getInvoices->export(
    request: $request
);

if ($response->exportInvoicesResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                | Type                                                                                                     | Required                                                                                                 | Description                                                                                              |
| -------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                               | [Operations\PostApiV2InvoicesExportsRequest](../../Models/Operations/PostApiV2InvoicesExportsRequest.md) | :heavy_check_mark:                                                                                       | The request object to use for the request.                                                               |

### Response

**[?Operations\PostApiV2InvoicesExportsResponse](../../Models/Operations/PostApiV2InvoicesExportsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getExportStatus


Wymagane uprawnienia: `InvoiceRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/invoices/exports/{operationReferenceNumber}" method="get" path="/api/v2/invoices/exports/{operationReferenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->getInvoices->getExportStatus(
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

**[?Operations\GetApiV2InvoicesExportsOperationReferenceNumberResponse](../../Models/Operations/GetApiV2InvoicesExportsOperationReferenceNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |