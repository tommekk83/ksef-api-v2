# Peppol

## Overview

### Available Operations

* [listProviders](#listproviders) - Pobranie listy dostawców usług Peppol

## listProviders

Zwraca listę dostawców usług Peppol zarejestrowanych w systemie.

**Sortowanie:**

- dateCreated (Desc)
- id (Asc)



### Example Usage

<!-- UsageSnippet language="php" operationID="listPeppolProviders" method="get" path="/peppol/query" -->
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
    pageOffset: 0,
    pageSize: 10

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

**[?Operations\ListPeppolProvidersResponse](../../Models/Operations/ListPeppolProvidersResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |