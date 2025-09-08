# Invoices
(*invoices*)

## Overview

### Available Operations

* [getByKsefNumber](#getbyksefnumber) - Pobranie faktury po numerze KSeF
* [queryMetadata](#querymetadata) - Pobranie listy metadanych faktur
* [export](#export) - [mock] Eksport paczki faktur
* [getFailed](#getfailed) - Pobranie niepoprawnie przetworzonych faktur sesji
* [getInvoiceUpoByKsefNumber](#getinvoiceupobyksefnumber) - Pobranie UPO faktury z sesji na podstawie numeru KSeF
* [getInvoiceUpo](#getinvoiceupo) - Pobranie UPO faktury z sesji na podstawie numeru referencyjnego faktury

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

**[?Operations\GetApiV2InvoicesKsefKsefNumberResponse](../../Models/Operations/GetApiV2InvoicesKsefKsefNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## queryMetadata

Zwraca listę metadanych faktur spełniające podane kryteria wyszukiwania.

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



$response = $sdk->invoices->queryMetadata(
    pageOffset: 0,
    pageSize: 10,
    requestBody: $requestBody

);

if ($response->queryInvoicesMetadataReponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                     | Type                                                                                                                          | Required                                                                                                                      | Description                                                                                                                   |
| ----------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                                                  | *?int*                                                                                                                        | :heavy_minus_sign:                                                                                                            | Indeks pierwszej strony wyników.                                                                                              |
| `pageSize`                                                                                                                    | *?int*                                                                                                                        | :heavy_minus_sign:                                                                                                            | Rozmiar strony wyników.                                                                                                       |
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



$response = $sdk->invoices->export(
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

## getFailed

Zwraca listę niepoprawnie przetworzonych faktur przesłanych w sesji wraz z ich statusami.

Wymagane uprawnienia: `InvoiceWrite`.

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

Wymagane uprawnienia: `InvoiceWrite`.

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

## getInvoiceUpo

Zwraca UPO faktury przesłanego w sesji na podstawie jego numeru KSeF.

Wymagane uprawnienia: `InvoiceWrite`.

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



$response = $sdk->invoices->getInvoiceUpo(
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