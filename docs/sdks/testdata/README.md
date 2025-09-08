# TestData
(*testData*)

## Overview

### Available Operations

* [createSubject](#createsubject) - Utworzenie podmiotu
* [removeSubject](#removesubject) - Usunięcie podmiotu
* [createPerson](#createperson) - Utworzenie osoby fizycznej
* [removePerson](#removeperson) - Usunięcie osoby fizycznej
* [assignPermissions](#assignpermissions) - Nadanie uprawnień testowemu podmiotowi/osobie fizycznej
* [revokePermissions](#revokepermissions) - Odebranie uprawnień testowemu podmiotowi/osobie fizycznej
* [addAttachment](#addattachment) - Umożliwienie wysyłania faktur z załącznikiem
* [revokeAttachment](#revokeattachment) - Odebranie możliwości wysyłania faktur z załącznikiem

## createSubject

Tworzenie nowego podmiotu testowego. W przypadku grupy VAT i JST istnieje możliwość stworzenia jednostek podrzędnych. W wyniku takiego działania w systemie powstanie powiązanie między tymi podmiotami.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/testdata/subject" method="post" path="/api/v2/testdata/subject" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->testData->createSubject(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Components\SubjectCreateRequest](../../Models/Components/SubjectCreateRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\PostApiV2TestdataSubjectResponse](../../Models/Operations/PostApiV2TestdataSubjectResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## removeSubject

Usuwanie podmiotu testowego. W przypadku grupy VAT i JST usunięte zostaną również jednostki podrzędne.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/testdata/subject/remove" method="post" path="/api/v2/testdata/subject/remove" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->testData->removeSubject(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Components\SubjectRemoveRequest](../../Models/Components/SubjectRemoveRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\PostApiV2TestdataSubjectRemoveResponse](../../Models/Operations/PostApiV2TestdataSubjectRemoveResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## createPerson

Tworzenie nowej osoby fizycznej, której system nadaje uprawnienia właścicielskie. Można również określić, czy osoba ta jest komornikiem – wówczas otrzyma odpowiednie uprawnienie egzekucyjne.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/testdata/person" method="post" path="/api/v2/testdata/person" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->testData->createPerson(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `$request`                                                                       | [Components\PersonCreateRequest](../../Models/Components/PersonCreateRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\PostApiV2TestdataPersonResponse](../../Models/Operations/PostApiV2TestdataPersonResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## removePerson

Usuwanie testowej osoby fizycznej. System automatycznie odbierze jej wszystkie uprawnienia.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/testdata/person/remove" method="post" path="/api/v2/testdata/person/remove" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->testData->removePerson(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `$request`                                                                       | [Components\PersonRemoveRequest](../../Models/Components/PersonRemoveRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\PostApiV2TestdataPersonRemoveResponse](../../Models/Operations/PostApiV2TestdataPersonRemoveResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## assignPermissions

Nadawanie uprawnień testowemu podmiotowi lub osobie fizycznej, a także w ich kontekście.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/testdata/permissions" method="post" path="/api/v2/testdata/permissions" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->testData->assignPermissions(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                | Type                                                                                                     | Required                                                                                                 | Description                                                                                              |
| -------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                               | [Components\TestDataPermissionsGrantRequest](../../Models/Components/TestDataPermissionsGrantRequest.md) | :heavy_check_mark:                                                                                       | The request object to use for the request.                                                               |

### Response

**[?Operations\PostApiV2TestdataPermissionsResponse](../../Models/Operations/PostApiV2TestdataPermissionsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revokePermissions

Odbieranie uprawnień nadanych testowemu podmiotowi lub osobie fizycznej, a także w ich kontekście.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/testdata/permissions/revoke" method="post" path="/api/v2/testdata/permissions/revoke" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->testData->revokePermissions(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                  | Type                                                                                                       | Required                                                                                                   | Description                                                                                                |
| ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                 | [Components\TestDataPermissionsRevokeRequest](../../Models/Components/TestDataPermissionsRevokeRequest.md) | :heavy_check_mark:                                                                                         | The request object to use for the request.                                                                 |

### Response

**[?Operations\PostApiV2TestdataPermissionsRevokeResponse](../../Models/Operations/PostApiV2TestdataPermissionsRevokeResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## addAttachment

Dodaje możliwość wysyłania faktur z załącznikiem przez wskazany podmiot

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/testdata/attachment" method="post" path="/api/v2/testdata/attachment" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->testData->addAttachment(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                  | Type                                                                                                       | Required                                                                                                   | Description                                                                                                |
| ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                 | [Components\AttachmentPermissionGrantRequest](../../Models/Components/AttachmentPermissionGrantRequest.md) | :heavy_check_mark:                                                                                         | The request object to use for the request.                                                                 |

### Response

**[?Operations\PostApiV2TestdataAttachmentResponse](../../Models/Operations/PostApiV2TestdataAttachmentResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revokeAttachment

Odbiera możliwość wysyłania faktur z załącznikiem przez wskazany podmiot

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/testdata/attachment/revoke" method="post" path="/api/v2/testdata/attachment/revoke" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->testData->revokeAttachment(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                    | Type                                                                                                         | Required                                                                                                     | Description                                                                                                  |
| ------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------ |
| `$request`                                                                                                   | [Components\AttachmentPermissionRevokeRequest](../../Models/Components/AttachmentPermissionRevokeRequest.md) | :heavy_check_mark:                                                                                           | The request object to use for the request.                                                                   |

### Response

**[?Operations\PostApiV2TestdataAttachmentRevokeResponse](../../Models/Operations/PostApiV2TestdataAttachmentRevokeResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |