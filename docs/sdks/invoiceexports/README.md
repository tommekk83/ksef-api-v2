# InvoiceExports
(*invoiceExports*)

## Overview

### Available Operations

* [getStatus](#getstatus) - [mock] Pobranie statusu eksportu paczki faktur

## getStatus


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



$response = $sdk->invoiceExports->getStatus(
    operationReferenceNumber: '<value>'
);

if ($response->invoicesExportStatusResponse !== null) {
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