# Peppol
(*peppol*)

## Overview

### Available Operations

* [listProviders](#listproviders) - Pobranie listy dostawców usług Peppol

## listProviders

Zwraca listę dostawców usług Peppol zarejestrowanych w systemie.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/peppol/query" method="get" path="/api/v2/peppol/query" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->peppol->listProviders(

);

if ($response->queryPeppolProvidersResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter               | Type                    | Required                | Description             |
| ----------------------- | ----------------------- | ----------------------- | ----------------------- |
| `pageOffset`            | *?int*                  | :heavy_minus_sign:      | Numer strony wyników.   |
| `pageSize`              | *?int*                  | :heavy_minus_sign:      | Rozmiar strony wyników. |

### Response

**[?Operations\GetApiV2PeppolQueryResponse](../../Models/Operations/GetApiV2PeppolQueryResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |