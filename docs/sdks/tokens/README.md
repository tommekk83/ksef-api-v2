# Tokens
(*tokens*)

## Overview

### Available Operations

* [generate](#generate) - Wygenerowanie nowego tokena
* [getList](#getlist) - Pobranie listy wygenerowanych tokenów
* [getStatus](#getstatus) - Pobranie statusu tokena
* [revoke](#revoke) - Unieważnienie tokena

## generate

Zwraca token, który może być użyty do uwierzytelniania się w KSeF.

Token może być generowany tylko w kontekście NIP lub identyfikatora wewnętrznego. Jest zwracany tylko raz. Zaczyna być aktywny w momencie gdy jego status zmieni się na `Active`.

### Example Usage

<!-- UsageSnippet language="php" operationID="generateToken" method="post" path="/api/v2/tokens" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->tokens->generate(
    request: $request
);

if ($response->generateTokenResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Components\GenerateTokenRequest](../../Models/Components/GenerateTokenRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\GenerateTokenResponse](../../Models/Operations/GenerateTokenResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getList

Pobranie listy wygenerowanych tokenów

### Example Usage

<!-- UsageSnippet language="php" operationID="getTokenList" method="get" path="/api/v2/tokens" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->tokens->getList(
    request: $request
);

if ($response->queryTokensResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `$request`                                                                       | [Operations\GetTokenListRequest](../../Models/Operations/GetTokenListRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\GetTokenListResponse](../../Models/Operations/GetTokenListResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getStatus

Pobranie statusu tokena

### Example Usage

<!-- UsageSnippet language="php" operationID="getTokenStatus" method="get" path="/api/v2/tokens/{referenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->tokens->getStatus(
    referenceNumber: '<value>'
);

if ($response->tokenStatusResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                  | Type                       | Required                   | Description                |
| -------------------------- | -------------------------- | -------------------------- | -------------------------- |
| `referenceNumber`          | *string*                   | :heavy_check_mark:         | Numer referencyjny tokena. |

### Response

**[?Operations\GetTokenStatusResponse](../../Models/Operations/GetTokenStatusResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revoke

Unieważniony token nie pozwoli już na uwierzytelnienie się za jego pomocą. Unieważnienie nie może zostać cofnięte.

### Example Usage

<!-- UsageSnippet language="php" operationID="revokeToken" method="delete" path="/api/v2/tokens/{referenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->tokens->revoke(
    referenceNumber: '<value>'
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                    | Type                                         | Required                                     | Description                                  |
| -------------------------------------------- | -------------------------------------------- | -------------------------------------------- | -------------------------------------------- |
| `referenceNumber`                            | *string*                                     | :heavy_check_mark:                           | Numer referencyjny tokena do unieważeniania. |

### Response

**[?Operations\RevokeTokenResponse](../../Models/Operations/RevokeTokenResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |