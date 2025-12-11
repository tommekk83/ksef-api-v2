# Limits

## Overview

### Available Operations

* [getContext](#getcontext) - Pobranie limitów dla bieżącego kontekstu
* [getSubject](#getsubject) - Pobranie limitów dla bieżącego podmiotu
* [getApiRate](#getapirate) - Pobranie aktualnie obowiązujących limitów API

## getContext

Zwraca wartości aktualnie obowiązujących limitów dla bieżącego kontekstu.

### Example Usage

<!-- UsageSnippet language="php" operationID="getContextLimits" method="get" path="/api/v2/limits/context" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->limits->getContext(

);

if ($response->effectiveContextLimits !== null) {
    // handle response
}
```

### Response

**[?Operations\GetContextLimitsResponse](../../Models/Operations/GetContextLimitsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getSubject

Zwraca wartoście aktualnie obowiązujących limitów dla bieżącego podmiotu.

### Example Usage

<!-- UsageSnippet language="php" operationID="getSubjectLimits" method="get" path="/api/v2/limits/subject" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->limits->getSubject(

);

if ($response->effectiveSubjectLimits !== null) {
    // handle response
}
```

### Response

**[?Operations\GetSubjectLimitsResponse](../../Models/Operations/GetSubjectLimitsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getApiRate

Zwraca wartości aktualnie obowiązujących limitów ilości żądań przesyłanych do API.

### Example Usage

<!-- UsageSnippet language="php" operationID="getApiRate" method="get" path="/api/v2/rate-limits" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->limits->getApiRate(

);

if ($response->effectiveApiRateLimits !== null) {
    // handle response
}
```

### Response

**[?Operations\GetApiRateResponse](../../Models/Operations/GetApiRateResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |