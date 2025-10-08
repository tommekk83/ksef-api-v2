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

<!-- UsageSnippet language="php" operationID="createSubject" method="post" path="/api/v2/testdata/subject" -->
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
| `$request`                                                                         | [Operations\CreateSubjectRequest](../../Models/Operations/CreateSubjectRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\CreateSubjectResponse](../../Models/Operations/CreateSubjectResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## removeSubject

Usuwanie podmiotu testowego. W przypadku grupy VAT i JST usunięte zostaną również jednostki podrzędne.

### Example Usage

<!-- UsageSnippet language="php" operationID="removeSubject" method="post" path="/api/v2/testdata/subject/remove" -->
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
| `$request`                                                                         | [Operations\RemoveSubjectRequest](../../Models/Operations/RemoveSubjectRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\RemoveSubjectResponse](../../Models/Operations/RemoveSubjectResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## createPerson

Tworzenie nowej osoby fizycznej, której system nadaje uprawnienia właścicielskie. Można również określić, czy osoba ta jest komornikiem – wówczas otrzyma odpowiednie uprawnienie egzekucyjne.

### Example Usage

<!-- UsageSnippet language="php" operationID="createPerson" method="post" path="/api/v2/testdata/person" -->
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
| `$request`                                                                       | [Operations\CreatePersonRequest](../../Models/Operations/CreatePersonRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\CreatePersonResponse](../../Models/Operations/CreatePersonResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## removePerson

Usuwanie testowej osoby fizycznej. System automatycznie odbierze jej wszystkie uprawnienia.

### Example Usage

<!-- UsageSnippet language="php" operationID="removePerson" method="post" path="/api/v2/testdata/person/remove" -->
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
| `$request`                                                                       | [Operations\RemovePersonRequest](../../Models/Operations/RemovePersonRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\RemovePersonResponse](../../Models/Operations/RemovePersonResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## assignPermissions

Nadawanie uprawnień testowemu podmiotowi lub osobie fizycznej, a także w ich kontekście.

### Example Usage

<!-- UsageSnippet language="php" operationID="assignPermissions" method="post" path="/api/v2/testdata/permissions" -->
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

$request = new Operations\AssignPermissionsRequest(
    contextIdentifier: new Operations\AssignPermissionsContextIdentifier(
        type: Components\TestDataContextIdentifierType::Nip,
        value: '5265877635',
    ),
    authorizedIdentifier: new Operations\AssignPermissionsAuthorizedIdentifier(
        type: Components\TestDataAuthorizedIdentifierType::Nip,
        value: '7762811692',
    ),
    permissions: [
        new Components\TestDataPermission(
            description: 'Opis testowy',
            permissionType: Components\TestDataPermissionType::InvoiceRead,
        ),
    ],
);

$response = $sdk->testData->assignPermissions(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                  | Type                                                                                       | Required                                                                                   | Description                                                                                |
| ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ |
| `$request`                                                                                 | [Operations\AssignPermissionsRequest](../../Models/Operations/AssignPermissionsRequest.md) | :heavy_check_mark:                                                                         | The request object to use for the request.                                                 |

### Response

**[?Operations\AssignPermissionsResponse](../../Models/Operations/AssignPermissionsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revokePermissions

Odbieranie uprawnień nadanych testowemu podmiotowi lub osobie fizycznej, a także w ich kontekście.

### Example Usage

<!-- UsageSnippet language="php" operationID="revokeTestPermissions" method="post" path="/api/v2/testdata/permissions/revoke" -->
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

$request = new Operations\RevokeTestPermissionsRequest(
    contextIdentifier: new Operations\RevokeTestPermissionsContextIdentifier(
        type: Components\TestDataContextIdentifierType::Nip,
        value: '5265877635',
    ),
    authorizedIdentifier: new Operations\RevokeTestPermissionsAuthorizedIdentifier(
        type: Components\TestDataAuthorizedIdentifierType::Nip,
        value: '7762811692',
    ),
);

$response = $sdk->testData->revokePermissions(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                          | Type                                                                                               | Required                                                                                           | Description                                                                                        |
| -------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------- |
| `$request`                                                                                         | [Operations\RevokeTestPermissionsRequest](../../Models/Operations/RevokeTestPermissionsRequest.md) | :heavy_check_mark:                                                                                 | The request object to use for the request.                                                         |

### Response

**[?Operations\RevokeTestPermissionsResponse](../../Models/Operations/RevokeTestPermissionsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## addAttachment

Dodaje możliwość wysyłania faktur z załącznikiem przez wskazany podmiot

### Example Usage

<!-- UsageSnippet language="php" operationID="addAttachment" method="post" path="/api/v2/testdata/attachment" -->
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

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Operations\AddAttachmentRequest](../../Models/Operations/AddAttachmentRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\AddAttachmentResponse](../../Models/Operations/AddAttachmentResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revokeAttachment

Odbiera możliwość wysyłania faktur z załącznikiem przez wskazany podmiot

### Example Usage

<!-- UsageSnippet language="php" operationID="revokeAttachment" method="post" path="/api/v2/testdata/attachment/revoke" -->
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

| Parameter                                                                                | Type                                                                                     | Required                                                                                 | Description                                                                              |
| ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- |
| `$request`                                                                               | [Operations\RevokeAttachmentRequest](../../Models/Operations/RevokeAttachmentRequest.md) | :heavy_check_mark:                                                                       | The request object to use for the request.                                               |

### Response

**[?Operations\RevokeAttachmentResponse](../../Models/Operations/RevokeAttachmentResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |