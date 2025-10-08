# Limits
(*limits*)

## Overview

### Available Operations

* [getContext](#getcontext) - Pobranie limitów dla bieżącego kontekstu
* [getSubject](#getsubject) - Pobranie limitów dla bieżącego podmiotu
* [updateContextSession](#updatecontextsession) - Zmiana limitów sesji dla bieżącego kontekstu
* [resetContextSession](#resetcontextsession) - Przywrócenie domyślnych wartości limitów sesji dla bieżącego kontekstu
* [updateSubjectCertificate](#updatesubjectcertificate) - Zmiana limitów certyfikatów dla bieżącego podmiotu
* [resetSubjectCertificate](#resetsubjectcertificate) - Przywrócenie domyślnych wartości limitów certyfikatów dla bieżącego podmiotu

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

## updateContextSession

Zmienia wartości aktualnie obowiązujących limitów sesji dla bieżącego kontekstu. **Tylko na środowiskach testowych.**

### Example Usage

<!-- UsageSnippet language="php" operationID="updateContextSessionLimits" method="post" path="/api/v2/testdata/limits/context/session" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->limits->updateContextSession(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                    | Type                                                                                                         | Required                                                                                                     | Description                                                                                                  |
| ------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------ |
| `$request`                                                                                                   | [Operations\UpdateContextSessionLimitsRequest](../../Models/Operations/UpdateContextSessionLimitsRequest.md) | :heavy_check_mark:                                                                                           | The request object to use for the request.                                                                   |

### Response

**[?Operations\UpdateContextSessionLimitsResponse](../../Models/Operations/UpdateContextSessionLimitsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## resetContextSession

Przywraca wartości aktualnie obowiązujących limitów sesji dla bieżącego kontekstu do wartości domyślnych. **Tylko na środowiskach testowych.**

### Example Usage

<!-- UsageSnippet language="php" operationID="resetContextSessionLimits" method="delete" path="/api/v2/testdata/limits/context/session" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->limits->resetContextSession(

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Response

**[?Operations\ResetContextSessionLimitsResponse](../../Models/Operations/ResetContextSessionLimitsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## updateSubjectCertificate

Zmienia wartości aktualnie obowiązujących limitów certyfikatów dla bieżącego podmiotu. **Tylko na środowiskach testowych.**

### Example Usage

<!-- UsageSnippet language="php" operationID="updateSubjectCertificateLimits" method="post" path="/api/v2/testdata/limits/subject/certificate" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->limits->updateSubjectCertificate(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                | Type                                                                                     | Required                                                                                 | Description                                                                              |
| ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- |
| `$request`                                                                               | [Components\SetSubjectLimitsRequest](../../Models/Components/SetSubjectLimitsRequest.md) | :heavy_check_mark:                                                                       | The request object to use for the request.                                               |

### Response

**[?Operations\UpdateSubjectCertificateLimitsResponse](../../Models/Operations/UpdateSubjectCertificateLimitsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## resetSubjectCertificate

Przywraca wartości aktualnie obowiązujących limitów certyfikatów dla bieżącego podmiotu do wartości domyślnych. **Tylko na środowiskach testowych.**

### Example Usage

<!-- UsageSnippet language="php" operationID="resetSubjectCertificateLimits" method="delete" path="/api/v2/testdata/limits/subject/certificate" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->limits->resetSubjectCertificate(

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Response

**[?Operations\ResetSubjectCertificateLimitsResponse](../../Models/Operations/ResetSubjectCertificateLimitsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |