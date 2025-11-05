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

**Wymagane uprawnienia**: `InvoiceRead`.

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

Zwraca metadane faktur spełniających filtry.

Limit techniczny: ≤ 10 000 rekordów na zestaw filtrów, po jego osiągnięciu <b>isTruncated = true</b> i należy ponownie ustawić <b>dateRange</b>, używając ostatniej daty z wyników (tj. ustawić from/to - w zależności od kierunku sortowania, od daty ostatniego zwróconego rekordu) oraz wyzerować <b>pageOffset</b>.

`Do scenariusza przyrostowego należy używać daty PermanentStorage oraz kolejność sortowania Asc`.

<b>Scenariusz pobierania przyrostowego (skrót):</b>
* Gdy <b>hasMore = false</b>, należy zakończyć,
* Gdy <b>hasMore = true</b> i <b>isTruncated = false</b>, należy zwiększyć <b>pageOffset</b>,
* Gdy <b>hasMore = true</b> i <b>isTruncated = true</b>, należy zawęzić <b>dateRange</b> (ustawić from od daty ostatniego rekordu), wyzerować <b>pageOffset</b> i kontynuować

**Sortowanie:**

- permanentStorageDate | invoicingDate | issueDate (Asc | Desc) - pole wybierane na podstawie filtrów



**Wymagane uprawnienia**: `InvoiceRead`.

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
    sortOrder: Operations\SortOrder::Asc,
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
| `sortOrder`                                                                                                                   | [?Operations\SortOrder](../../Models/Operations/SortOrder.md)                                                                 | :heavy_minus_sign:                                                                                                            | Kolejność sortowania wyników.<br/>\| Wartość \| Opis \|<br/>\| --- \| --- \|<br/>\| Asc \| Sortowanie rosnąco. \|<br/>\| Desc \| Sortowanie malejąco. \|<br/> |
| `pageOffset`                                                                                                                  | *?int*                                                                                                                        | :heavy_minus_sign:                                                                                                            | Indeks pierwszej strony wyników (0 = pierwsza strona).                                                                        |
| `pageSize`                                                                                                                    | *?int*                                                                                                                        | :heavy_minus_sign:                                                                                                            | Rozmiar strony wyników.                                                                                                       |
| `requestBody`                                                                                                                 | [?Operations\GetInvoicesListRequestBody](../../Models/Operations/GetInvoicesListRequestBody.md)                               | :heavy_minus_sign:                                                                                                            | Kryteria filtrowania.                                                                                                         |

### Response

**[?Operations\GetInvoicesListResponse](../../Models/Operations/GetInvoicesListResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## export

Rozpoczyna asynchroniczny proces wyszukiwania faktur w systemie KSeF na podstawie przekazanych filtrów oraz przygotowania ich w formie zaszyfrowanej paczki.
Wymagane jest przekazanie informacji o szyfrowaniu w polu <b>Encryption</b>, które służą do zabezpieczenia przygotowanej paczki z fakturami.
Maksymalnie można uruchomić 10 równoczesnych eksportów w zalogowanym kontekście.

System pobiera faktury rosnąco według daty określonej w filtrze (Invoicing, Issue, PermanentStorage) i dodaje je do paczki aż do osiągnięcia jednego z poniższych limitów:
* Limit liczby faktur: 10 000 sztuk
* Limit rozmiaru danych(skompresowanych): 1GB

Paczka eksportu zawiera dodatkowy plik z metadanymi faktur w formacie JSON (`_metadata.json`). Zawartość pliku to
obiekt z tablicą <b>invoices</b>, gdzie każdy element jest obiektem typu <b>InvoiceMetadata</b>
(taki jak zwracany przez endpoint `POST /invoices/query/metadata`).

<b>Plik z metadanymi(_metadata.json) nie jest wliczany do limitów algorytmu budowania paczki</b>. 

`Do realizacji pobierania przyrostowego należy stosować filtrowanie po dacie PermanentStorage`.

**Sortowanie:**

- permanentStorageDate | invoicingDate | issueDate (Asc) - pole wybierane na podstawie filtrów



**Wymagane uprawnienia**: `InvoiceRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="export" method="post" path="/api/v2/invoices/exports" -->
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

$request = new Operations\ExportRequest(
    encryption: new Operations\ExportEncryption(
        encryptedSymmetricKey: 'Rk1Qb1VhVjMyQ3NxQ1h1WlVtZUdHcDJSZ0pTbE5IbWQ=',
        initializationVector: 'c29tZUluaXRWZWN0b3I=',
    ),
    filters: new Operations\Filters(
        subjectType: Components\InvoiceQuerySubjectType::Subject1,
        dateRange: new Operations\ExportDateRange(
            dateType: Components\InvoiceQueryDateType::Issue,
            from: Utils\Utils::parseDateTime('2025-08-28T09:22:13.388+00:00'),
            to: Utils\Utils::parseDateTime('2025-09-28T09:22:13.388+00:00'),
        ),
    ),
);

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

Paczka faktur jest dzielona na części o maksymalnym rozmiarze 50 MB. Każda część jest zaszyfrowana algorytmem AES-256-CBC z dopełnieniem PKCS#7, przy użyciu klucza symetrycznego przekazanego podczas inicjowania eksportu. 

W przypadku ucięcia wyniku eksportu z powodu przekroczenia limitów, zwracana jest flaga <b>IsTruncated = true</b> oraz odpowiednia data, którą należy wykorzystać do wykonania kolejnego eksportu, aż do momentu, gdy flaga <b>IsTruncated = false</b>.

**Sortowanie:**

- permanentStorageDate | invoicingDate | issueDate (Asc) - pole wybierane na podstawie filtrów



**Wymagane uprawnienia**: `InvoiceRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="getExportStatus" method="get" path="/api/v2/invoices/exports/{referenceNumber}" -->
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
    referenceNumber: '<value>'
);

if ($response->invoiceExportStatusResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                           | Type                                | Required                            | Description                         |
| ----------------------------------- | ----------------------------------- | ----------------------------------- | ----------------------------------- |
| `referenceNumber`                   | *string*                            | :heavy_check_mark:                  | Numer referencyjny eksportu faktur. |

### Response

**[?Operations\GetExportStatusResponse](../../Models/Operations/GetExportStatusResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |