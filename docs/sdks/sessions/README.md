# Sessions
(*sessions*)

## Overview

### Available Operations

* [list](#list) - Pobranie listy sesji
* [getStatus](#getstatus) - Pobranie statusu sesji
* [getUpo](#getupo) - Pobranie UPO dla sesji
* [openOnline](#openonline) - Otwarcie sesji interaktywnej
* [closeOnline](#closeonline) - Zamknięcie sesji interaktywnej
* [closeBatch](#closebatch) - Zamknięcie sesji wsadowej

## list

Zwraca listę sesji spełniających podane kryteria wyszukiwania.

Wymagane uprawnienia: `Introspection`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/sessions" method="get" path="/api/v2/sessions" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;
use Intermedia\Ksef\Apiv2\Models\Components;
use Intermedia\Ksef\Apiv2\Models\Operations;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$request = new Operations\GetApiV2SessionsRequest(
    sessionType: Components\SessionType::Batch,
);

$response = $sdk->sessions->list(
    request: $request
);

if ($response->sessionsQueryResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                | Type                                                                                     | Required                                                                                 | Description                                                                              |
| ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- |
| `$request`                                                                               | [Operations\GetApiV2SessionsRequest](../../Models/Operations/GetApiV2SessionsRequest.md) | :heavy_check_mark:                                                                       | The request object to use for the request.                                               |

### Response

**[?Operations\GetApiV2SessionsResponse](../../Models/Operations/GetApiV2SessionsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getStatus

Sprawdza bieżący status sesji o podanym numerze referencyjnym.

Wymagane uprawnienia: `InvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/sessions/{referenceNumber}" method="get" path="/api/v2/sessions/{referenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessions->getStatus(
    referenceNumber: '<value>'
);

if ($response->sessionStatusResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                 | Type                      | Required                  | Description               |
| ------------------------- | ------------------------- | ------------------------- | ------------------------- |
| `referenceNumber`         | *string*                  | :heavy_check_mark:        | Numer referencyjny sesji. |

### Response

**[?Operations\GetApiV2SessionsReferenceNumberResponse](../../Models/Operations/GetApiV2SessionsReferenceNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getUpo

Zwraca XML zawierający zbiorcze UPO dla sesji.

Wymagane uprawnienia: `InvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/sessions/{referenceNumber}/upo/{upoReferenceNumber}" method="get" path="/api/v2/sessions/{referenceNumber}/upo/{upoReferenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessions->getUpo(
    referenceNumber: '<value>',
    upoReferenceNumber: '<value>'

);

if ($response->res !== null) {
    // handle response
}
```

### Parameters

| Parameter                 | Type                      | Required                  | Description               |
| ------------------------- | ------------------------- | ------------------------- | ------------------------- |
| `referenceNumber`         | *string*                  | :heavy_check_mark:        | Numer referencyjny sesji. |
| `upoReferenceNumber`      | *string*                  | :heavy_check_mark:        | Numer referencyjny UPO.   |

### Response

**[?Operations\GetApiV2SessionsReferenceNumberUpoUpoReferenceNumberResponse](../../Models/Operations/GetApiV2SessionsReferenceNumberUpoUpoReferenceNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## openOnline

Otwiera sesję do wysyłki pojedynczych faktur. Należy przekazać schemat wysyłanych faktur oraz informacje o kluczu używanym do szyfrowania.

> Więcej informacji:
> - [Otwarcie sesji interaktywnej](https://github.com/CIRFMF/ksef-docs/blob/main/sesja-interaktywna.md#1-otwarcie-sesji)
> - [Klucz publiczny Ministersta Finansów](/public-keys/publicKey.pem)

Wymagane uprawnienia: `InvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="onlineSession.open" method="post" path="/api/v2/sessions/online" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;
use Intermedia\Ksef\Apiv2\Models\Operations;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$request = new Operations\OnlineSessionOpenRequest(
    formCode: new Operations\OnlineSessionOpenFormCode(
        systemCode: 'FA (2)',
        schemaVersion: '1-0E',
        value: 'FA',
    ),
    encryption: new Operations\OnlineSessionOpenEncryption(
        encryptedSymmetricKey: 'bdUVjqLj+y2q6aBUuLxxXYAMqeDuIBRTyr+hB96DaWKaGzuVHw9p+Nk9vhzgF/Q5cavK2k6eCh6SdsrWI0s9mFFj4A4UJtsyD8Dn3esLfUZ5A1juuG3q3SBi/XOC/+9W+0T/KdwdE393mbiUNyx1K/0bw31vKJL0COeJIDP7usAMDl42/H1TNvkjk+8iZ80V0qW7D+RZdz+tdiY1xV0f2mfgwJ46V0CpZ+sB9UAssRj+eVffavJ0TOg2b5JaBxE8MCAvrF6rO5K4KBjUmoy7PP7g1qIbm8xI2GO0KnfPOO5OWj8rsotRwBgu7x19Ine3qYUvuvCZlXRGGZ5NHIzWPM4O74+gNalaMgFCsmv8mMhETSU4SfAGmJr9edxPjQSbgD5i2X4eDRDMwvyaAa7CP1b2oICju+0L7Fywd2ZtUcr6El++eTVoi8HYsTArntET++gULT7XXjmb8e3O0nxrYiYsE9GMJ7HBGv3NOoJ1NTm3a7U6+c0ZJiBVLvn6xXw10LQX243xH+ehsKo6djQJKYtqcNPaXtCwM1c9RrsOx/wRXyWCtTffqLiaR0LbYvfMJAcEWceG+RaeAx4p37OiQqdJypd6LAv9/0ECWK8Bip8yyoA+0EYiAJb9YuDz2YlQX9Mx9E9FzFIAsgEQ2w723HZYWgPywLb+dlsum4lTZKQ=',
        initializationVector: 'OmtDQdl6vkOI1GLKZSjgEg==',
    ),
);

$response = $sdk->sessions->openOnline(
    request: $request
);

if ($response->openOnlineSessionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                  | Type                                                                                       | Required                                                                                   | Description                                                                                |
| ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ |
| `$request`                                                                                 | [Operations\OnlineSessionOpenRequest](../../Models/Operations/OnlineSessionOpenRequest.md) | :heavy_check_mark:                                                                         | The request object to use for the request.                                                 |

### Response

**[?Operations\OnlineSessionOpenResponse](../../Models/Operations/OnlineSessionOpenResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## closeOnline

Zamyka sesję interaktywną i rozpoczyna generowanie zbiorczego UPO dla sesji.

Wymagane uprawnienia: `InvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/sessions/online/{referenceNumber}/close" method="post" path="/api/v2/sessions/online/{referenceNumber}/close" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessions->closeOnline(
    referenceNumber: '<value>'
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                | Type                     | Required                 | Description              |
| ------------------------ | ------------------------ | ------------------------ | ------------------------ |
| `referenceNumber`        | *string*                 | :heavy_check_mark:       | Numer referencyjny sesji |

### Response

**[?Operations\PostApiV2SessionsOnlineReferenceNumberCloseResponse](../../Models/Operations/PostApiV2SessionsOnlineReferenceNumberCloseResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## closeBatch

Zamyka sesję wsadową, rozpoczyna procesowanie paczki faktur i generowanie UPO dla prawidłowych faktur oraz zbiorczego UPO dla sesji.

Wymagane uprawnienia: `InvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/sessions/batch/{referenceNumber}/close" method="post" path="/api/v2/sessions/batch/{referenceNumber}/close" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->sessions->closeBatch(
    referenceNumber: '<value>'
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                | Type                     | Required                 | Description              |
| ------------------------ | ------------------------ | ------------------------ | ------------------------ |
| `referenceNumber`        | *string*                 | :heavy_check_mark:       | Numer referencyjny sesji |

### Response

**[?Operations\PostApiV2SessionsBatchReferenceNumberCloseResponse](../../Models/Operations/PostApiV2SessionsBatchReferenceNumberCloseResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |