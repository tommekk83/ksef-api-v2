# Permissions
(*permissions*)

## Overview

### Available Operations

* [grantToPersons](#granttopersons) - Nadanie osobom fizycznym uprawnień do pracy w KSeF
* [grantToEntities](#granttoentities) - Nadanie podmiotom uprawnień do obsługi faktur
* [grantAuthorizations](#grantauthorizations) - Nadanie uprawnień podmiotowych
* [grantIndirectly](#grantindirectly) - Nadanie uprawnień w sposób pośredni
* [grantToSubunits](#granttosubunits) - Nadanie uprawnień administratora podmiotu podrzędnego
* [grantRights](#grantrights) - Nadanie uprawnień administratora podmiotu unijnego
* [grantToEuEntities](#granttoeuentities) - Nadanie uprawnień reprezentanta podmiotu unijnego
* [revoke](#revoke) - Odebranie uprawnień
* [revokeAuthorizations](#revokeauthorizations) - Odebranie uprawnień podmiotowych
* [getOperationStatus](#getoperationstatus) - Pobranie statusu operacji
* [checkAttachmentStatus](#checkattachmentstatus) - Sprawdzenie statusu zgody na wystawianie faktur z załącznikiem
* [getPersonalGrants](#getpersonalgrants) - Pobranie listy własnych uprawnień
* [getPersonGrants](#getpersongrants) - Pobranie listy uprawnień do pracy w KSeF nadanych osobom fizycznym lub podmiotom
* [getSubunitsGrants](#getsubunitsgrants) - Pobranie listy uprawnień administratorów jednostek i podmiotów podrzędnych
* [getEntityRoles](#getentityroles) - Pobranie listy ról podmiotu
* [getSubordinateEntitiesRoles](#getsubordinateentitiesroles) - Pobranie listy podmiotów podrzędnych
* [getAuthorizationsGrants](#getauthorizationsgrants) - Pobranie listy uprawnień podmiotowych do obsługi faktur
* [getEuEntityGrants](#geteuentitygrants) - Pobranie listy uprawnień administratorów lub reprezentantów podmiotów unijnych uprawnionych do samofakturowania

## grantToPersons

Rozpoczyna asynchroniczną operację nadawania osobom fizycznym uprawnień do pracy w KSeF.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadawanie-uprawnie%C5%84-osobom-fizycznym-do-pracy-w-ksef)

Wymagane uprawnienia: `CredentialsManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/persons/grants" method="post" path="/api/v2/permissions/persons/grants" -->
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

$request = new Operations\PostApiV2PermissionsPersonsGrantsRequest(
    subjectIdentifier: new Operations\PostApiV2PermissionsPersonsGrantsSubjectIdentifier(
        type: Components\PersonPermissionsSubjectIdentifierType::Pesel,
        value: '15062788702',
    ),
    permissions: [
        Components\PersonPermissionType::InvoiceRead,
        Components\PersonPermissionType::InvoiceWrite,
    ],
    description: 'Uprawnienia do odczytu i wysyłania faktur',
);

$response = $sdk->permissions->grantToPersons(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                  | Type                                                                                                                       | Required                                                                                                                   | Description                                                                                                                |
| -------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                                 | [Operations\PostApiV2PermissionsPersonsGrantsRequest](../../Models/Operations/PostApiV2PermissionsPersonsGrantsRequest.md) | :heavy_check_mark:                                                                                                         | The request object to use for the request.                                                                                 |

### Response

**[?Operations\PostApiV2PermissionsPersonsGrantsResponse](../../Models/Operations/PostApiV2PermissionsPersonsGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## grantToEntities

Rozpoczyna asynchroniczną operację nadawania podmiotom uprawnień do obsługi faktur.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-podmiotom-uprawnie%C5%84-do-obs%C5%82ugi-faktur)

Wymagane uprawnienia: `CredentialsManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/entities/grants" method="post" path="/api/v2/permissions/entities/grants" -->
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

$request = new Operations\PostApiV2PermissionsEntitiesGrantsRequest(
    subjectIdentifier: new Operations\PostApiV2PermissionsEntitiesGrantsSubjectIdentifier(
        type: Components\EntityPermissionsSubjectIdentifierType::Nip,
        value: '7762811692',
    ),
    permissions: [
        new Components\EntityPermission(
            type: Components\EntityPermissionType::InvoiceRead,
            canDelegate: true,
        ),
        new Components\EntityPermission(
            type: Components\EntityPermissionType::InvoiceWrite,
            canDelegate: true,
        ),
    ],
    description: 'Uprawnienia do odczytu i wysyłania faktur z możliwością nadania ich pośrednio',
);

$response = $sdk->permissions->grantToEntities(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                    | Type                                                                                                                         | Required                                                                                                                     | Description                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                                   | [Operations\PostApiV2PermissionsEntitiesGrantsRequest](../../Models/Operations/PostApiV2PermissionsEntitiesGrantsRequest.md) | :heavy_check_mark:                                                                                                           | The request object to use for the request.                                                                                   |

### Response

**[?Operations\PostApiV2PermissionsEntitiesGrantsResponse](../../Models/Operations/PostApiV2PermissionsEntitiesGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## grantAuthorizations

Rozpoczyna asynchroniczną operację nadawania uprawnień podmiotowych.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-podmiotowych)

Wymagane uprawnienia: `CredentialsManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/authorizations/grants" method="post" path="/api/v2/permissions/authorizations/grants" -->
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

$request = new Operations\PostApiV2PermissionsAuthorizationsGrantsRequest(
    subjectIdentifier: new Operations\PostApiV2PermissionsAuthorizationsGrantsSubjectIdentifier(
        type: Components\EntityAuthorizationPermissionsSubjectIdentifierType::Nip,
        value: '7762811692',
    ),
    permission: Components\EntityAuthorizationPermissionType::SelfInvoicing,
    description: 'Uprawnienia do samofakturowania',
);

$response = $sdk->permissions->grantAuthorizations(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                | Type                                                                                                                                     | Required                                                                                                                                 | Description                                                                                                                              |
| ---------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                                               | [Operations\PostApiV2PermissionsAuthorizationsGrantsRequest](../../Models/Operations/PostApiV2PermissionsAuthorizationsGrantsRequest.md) | :heavy_check_mark:                                                                                                                       | The request object to use for the request.                                                                                               |

### Response

**[?Operations\PostApiV2PermissionsAuthorizationsGrantsResponse](../../Models/Operations/PostApiV2PermissionsAuthorizationsGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## grantIndirectly

Rozpoczyna asynchroniczną operację nadawania uprawnień w sposób pośredni.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-w-spos%C3%B3b-po%C5%9Bredni)

Wymagane uprawnienia: `CredentialsManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/indirect/grants" method="post" path="/api/v2/permissions/indirect/grants" -->
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

$request = new Operations\PostApiV2PermissionsIndirectGrantsRequest(
    subjectIdentifier: new Operations\PostApiV2PermissionsIndirectGrantsSubjectIdentifier(
        type: Components\IndirectPermissionsSubjectIdentifierType::Pesel,
        value: '15062788702',
    ),
    permissions: [
        Components\IndirectPermissionType::InvoiceWrite,
        Components\IndirectPermissionType::InvoiceRead,
    ],
    description: 'Uprawnienia generalne do odczytu i wysyłania faktur, nadane w sposób pośredni',
);

$response = $sdk->permissions->grantIndirectly(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                    | Type                                                                                                                         | Required                                                                                                                     | Description                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                                   | [Operations\PostApiV2PermissionsIndirectGrantsRequest](../../Models/Operations/PostApiV2PermissionsIndirectGrantsRequest.md) | :heavy_check_mark:                                                                                                           | The request object to use for the request.                                                                                   |

### Response

**[?Operations\PostApiV2PermissionsIndirectGrantsResponse](../../Models/Operations/PostApiV2PermissionsIndirectGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## grantToSubunits

Rozpoczyna asynchroniczną operację nadawania uprawnień administratora podmiotu podrzędnego.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-administratora-podmiotu-podrz%C4%99dnego)

Wymagane uprawnienia: `SubunitManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/subunits/grants" method="post" path="/api/v2/permissions/subunits/grants" -->
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

$request = new Operations\PostApiV2PermissionsSubunitsGrantsRequest(
    subjectIdentifier: new Operations\PostApiV2PermissionsSubunitsGrantsSubjectIdentifier(
        type: Components\SubunitPermissionsSubjectIdentifierType::Pesel,
        value: '15062788702',
    ),
    contextIdentifier: new Operations\PostApiV2PermissionsSubunitsGrantsContextIdentifier(
        type: Components\SubunitPermissionsContextIdentifierType::InternalId,
        value: '7762811692-11111',
    ),
    description: 'Administrator jednostki podrzędnej',
);

$response = $sdk->permissions->grantToSubunits(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                    | Type                                                                                                                         | Required                                                                                                                     | Description                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                                   | [Operations\PostApiV2PermissionsSubunitsGrantsRequest](../../Models/Operations/PostApiV2PermissionsSubunitsGrantsRequest.md) | :heavy_check_mark:                                                                                                           | The request object to use for the request.                                                                                   |

### Response

**[?Operations\PostApiV2PermissionsSubunitsGrantsResponse](../../Models/Operations/PostApiV2PermissionsSubunitsGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## grantRights

Rozpoczyna asynchroniczną operację nadawania uprawnień administratora podmiotu unijnego.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-administratora-podmiotu-unijnego)

Wymagane uprawnienia: `CredentialsManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/eu-entities/administration/grants" method="post" path="/api/v2/permissions/eu-entities/administration/grants" -->
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

$request = new Operations\PostApiV2PermissionsEuEntitiesAdministrationGrantsRequest(
    subjectIdentifier: new Operations\PostApiV2PermissionsEuEntitiesAdministrationGrantsSubjectIdentifier(
        type: Components\EuEntityAdministrationPermissionsSubjectIdentifierType::Fingerprint,
        value: 'CEB3643BAC2C111ADDE971BDA5A80163441867D65389FC0BC0DFF8B4C1CD4E59',
    ),
    contextIdentifier: new Operations\PostApiV2PermissionsEuEntitiesAdministrationGrantsContextIdentifier(
        type: Components\EuEntityAdministrationPermissionsContextIdentifierType::NipVatUe,
        value: '7762811692-DE123456789012',
    ),
    description: 'Administrator podmiotu unijnego DE123456789012',
    euEntityName: 'Nazwa podmiotu unijnego',
);

$response = $sdk->permissions->grantRights(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                    | Type                                                                                                                                                         | Required                                                                                                                                                     | Description                                                                                                                                                  |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `$request`                                                                                                                                                   | [Operations\PostApiV2PermissionsEuEntitiesAdministrationGrantsRequest](../../Models/Operations/PostApiV2PermissionsEuEntitiesAdministrationGrantsRequest.md) | :heavy_check_mark:                                                                                                                                           | The request object to use for the request.                                                                                                                   |

### Response

**[?Operations\PostApiV2PermissionsEuEntitiesAdministrationGrantsResponse](../../Models/Operations/PostApiV2PermissionsEuEntitiesAdministrationGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## grantToEuEntities

Rozpoczyna asynchroniczną operację nadawania uprawnień reprezentanta podmiotu unijnego.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-reprezentanta-podmiotu-unijnego)

Wymagane uprawnienia: `VatUeManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/eu-entities/grants" method="post" path="/api/v2/permissions/eu-entities/grants" -->
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

$request = new Operations\PostApiV2PermissionsEuEntitiesGrantsRequest(
    subjectIdentifier: new Operations\PostApiV2PermissionsEuEntitiesGrantsSubjectIdentifier(
        type: Components\EuEntityPermissionsSubjectIdentifierType::Fingerprint,
        value: 'CEB3643BAC2C111ADDE971BDA5A80163441867D65389FC0BC0DFF8B4C1CD4E59',
    ),
    permissions: [
        Components\EuEntityPermissionType::InvoiceRead,
        Components\EuEntityPermissionType::InvoiceWrite,
    ],
    description: 'Reprezentant podmiotu unijnego',
);

$response = $sdk->permissions->grantToEuEntities(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                        | Type                                                                                                                             | Required                                                                                                                         | Description                                                                                                                      |
| -------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                                       | [Operations\PostApiV2PermissionsEuEntitiesGrantsRequest](../../Models/Operations/PostApiV2PermissionsEuEntitiesGrantsRequest.md) | :heavy_check_mark:                                                                                                               | The request object to use for the request.                                                                                       |

### Response

**[?Operations\PostApiV2PermissionsEuEntitiesGrantsResponse](../../Models/Operations/PostApiV2PermissionsEuEntitiesGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revoke

Rozpoczyna asynchroniczną operacje odbierania uprawnienia o podanym identyfikatorze.

Ta metoda służy do odbierania uprawnień takich jak:
- nadanych nadanych osobom fizycznym lub podmiotom do pracy w KSeF
- nadanych podmiotom do obsługi faktur
- nadanych w sposób pośredni
- administratorów jednostek i podmiotów podrzędnych
- administratorów podmiotów unijnych uprawnionych do samofakturowania
- reprezentantów podmiotów unijnych

> Więcej informacji:
> - [Odbieranie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#odebranie-uprawnie%C5%84)

Wymagane uprawnienia: `CredentialsManage`, `VatUeManage`, `SubunitManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="delete_/api/v2/permissions/common/grants/{permissionId}" method="delete" path="/api/v2/permissions/common/grants/{permissionId}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->permissions->revoke(
    permissionId: '<id>'
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter          | Type               | Required           | Description        |
| ------------------ | ------------------ | ------------------ | ------------------ |
| `permissionId`     | *string*           | :heavy_check_mark: | Id uprawnienia.    |

### Response

**[?Operations\DeleteApiV2PermissionsCommonGrantsPermissionIdResponse](../../Models/Operations/DeleteApiV2PermissionsCommonGrantsPermissionIdResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revokeAuthorizations

Rozpoczyna asynchroniczną operacje odbierania uprawnienia o podanym identyfikatorze.
Ta metoda służy do odbierania uprawnień podmiotowych.

> Więcej informacji:
> - [Odbieranie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#odebranie-uprawnie%C5%84-podmiotowych)

Wymagane uprawnienia: `CredentialsManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="delete_/api/v2/permissions/authorizations/grants/{permissionId}" method="delete" path="/api/v2/permissions/authorizations/grants/{permissionId}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->permissions->revokeAuthorizations(
    permissionId: '<id>'
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter          | Type               | Required           | Description        |
| ------------------ | ------------------ | ------------------ | ------------------ |
| `permissionId`     | *string*           | :heavy_check_mark: | Id uprawnienia.    |

### Response

**[?Operations\DeleteApiV2PermissionsAuthorizationsGrantsPermissionIdResponse](../../Models/Operations/DeleteApiV2PermissionsAuthorizationsGrantsPermissionIdResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getOperationStatus

Zwraca status operacji asynchronicznej związanej z nadaniem lub odebraniem uprawnień.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/permissions/operations/{operationReferenceNumber}" method="get" path="/api/v2/permissions/operations/{operationReferenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->permissions->getOperationStatus(
    operationReferenceNumber: '<value>'
);

if ($response->permissionsOperationStatusResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                   | Type                        | Required                    | Description                 |
| --------------------------- | --------------------------- | --------------------------- | --------------------------- |
| `operationReferenceNumber`  | *string*                    | :heavy_check_mark:          | Numer referencyjny operacji |

### Response

**[?Operations\GetApiV2PermissionsOperationsOperationReferenceNumberResponse](../../Models/Operations/GetApiV2PermissionsOperationsOperationReferenceNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## checkAttachmentStatus

Sprawdzenie czy obecny kontekst posiada zgodę na wystawianie faktur z załącznikiem.

Wymagane uprawnienia: `CredentialsManage`, `CredentialsRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/permissions/attachments/status" method="get" path="/api/v2/permissions/attachments/status" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->permissions->checkAttachmentStatus(

);

if ($response->checkAttachmentPermissionStatusResponse !== null) {
    // handle response
}
```

### Response

**[?Operations\GetApiV2PermissionsAttachmentsStatusResponse](../../Models/Operations/GetApiV2PermissionsAttachmentsStatusResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getPersonalGrants

Zwraca listę uprawnień przysługujących uwierzytelnionemu podmiotowi.

> Więcej informacji:
> - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-w%C5%82asnych-uprawnie%C5%84)

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/query/personal/grants" method="post" path="/api/v2/permissions/query/personal/grants" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->permissions->getPersonalGrants(
    personalPermissionsQueryRequest: $personalPermissionsQueryRequest
);

if ($response->queryPersonalPermissionsResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                 | Type                                                                                                      | Required                                                                                                  | Description                                                                                               |
| --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                              | *?int*                                                                                                    | :heavy_minus_sign:                                                                                        | Numer strony wyników.                                                                                     |
| `pageSize`                                                                                                | *?int*                                                                                                    | :heavy_minus_sign:                                                                                        | Rozmiar strony wyników.                                                                                   |
| `personalPermissionsQueryRequest`                                                                         | [?Components\PersonalPermissionsQueryRequest](../../Models/Components/PersonalPermissionsQueryRequest.md) | :heavy_minus_sign:                                                                                        | N/A                                                                                                       |

### Response

**[?Operations\PostApiV2PermissionsQueryPersonalGrantsResponse](../../Models/Operations/PostApiV2PermissionsQueryPersonalGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getPersonGrants

Zwraca listę uprawnień do pracy w KSeF nadanych osobom fizycznym lub podmiotom.

> Więcej informacji:
> - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-uprawnie%C5%84-do-pracy-w-ksef-nadanych-osobom-fizycznym-lub-podmiotom)

Wymagane uprawnienia: `CredentialsManage`, `CredentialsRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/query/persons/grants" method="post" path="/api/v2/permissions/query/persons/grants" -->
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

$requestBody = new Operations\PostApiV2PermissionsQueryPersonsGrantsRequestBody(
    authorIdentifier: new Operations\AuthorIdentifier(
        type: Components\PersonPermissionsAuthorIdentifierType::Nip,
        value: '7762811692',
    ),
    permissionTypes: [
        Components\PersonPermissionType::CredentialsManage,
        Components\PersonPermissionType::CredentialsRead,
        Components\PersonPermissionType::InvoiceWrite,
    ],
    permissionState: Operations\PermissionState::Active,
    queryType: Components\PersonPermissionsQueryType::PermissionsInCurrentContext,
);

$response = $sdk->permissions->getPersonGrants(
    requestBody: $requestBody
);

if ($response->queryPersonPermissionsResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                     | Type                                                                                                                                          | Required                                                                                                                                      | Description                                                                                                                                   |
| --------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                                                                  | *?int*                                                                                                                                        | :heavy_minus_sign:                                                                                                                            | Numer strony wyników.                                                                                                                         |
| `pageSize`                                                                                                                                    | *?int*                                                                                                                                        | :heavy_minus_sign:                                                                                                                            | Rozmiar strony wyników.                                                                                                                       |
| `requestBody`                                                                                                                                 | [?Operations\PostApiV2PermissionsQueryPersonsGrantsRequestBody](../../Models/Operations/PostApiV2PermissionsQueryPersonsGrantsRequestBody.md) | :heavy_minus_sign:                                                                                                                            | N/A                                                                                                                                           |

### Response

**[?Operations\PostApiV2PermissionsQueryPersonsGrantsResponse](../../Models/Operations/PostApiV2PermissionsQueryPersonsGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getSubunitsGrants

Zwraca listę uprawnień administratorów jednostek i podmiotów podrzędnych.

> Więcej informacji:
> - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-uprawnie%C5%84-administrator%C3%B3w-jednostek-i-podmiot%C3%B3w-podrz%C4%99dnych)

Wymagane uprawnienia: `CredentialsManage`, `CredentialsRead`, `SubunitManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/query/subunits/grants" method="post" path="/api/v2/permissions/query/subunits/grants" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;
use Intermedia\Ksef\Apiv2\Models\Components;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$subunitPermissionsQueryRequest = new Components\SubunitPermissionsQueryRequest(
    subunitIdentifier: new Components\SubunitPermissionsQueryRequestSubunitIdentifier(
        type: Components\SubunitPermissionsSubunitIdentifierType::InternalId,
        value: '7762811692-12345',
    ),
);

$response = $sdk->permissions->getSubunitsGrants(
    subunitPermissionsQueryRequest: $subunitPermissionsQueryRequest
);

if ($response->querySubunitPermissionsResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                               | Type                                                                                                    | Required                                                                                                | Description                                                                                             |
| ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                            | *?int*                                                                                                  | :heavy_minus_sign:                                                                                      | Numer strony wyników.                                                                                   |
| `pageSize`                                                                                              | *?int*                                                                                                  | :heavy_minus_sign:                                                                                      | Rozmiar strony wyników.                                                                                 |
| `subunitPermissionsQueryRequest`                                                                        | [?Components\SubunitPermissionsQueryRequest](../../Models/Components/SubunitPermissionsQueryRequest.md) | :heavy_minus_sign:                                                                                      | N/A                                                                                                     |

### Response

**[?Operations\PostApiV2PermissionsQuerySubunitsGrantsResponse](../../Models/Operations/PostApiV2PermissionsQuerySubunitsGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getEntityRoles

Zwraca listę ról podmiotu.

> Więcej informacji:
> - [Pobieranie listy ról](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-r%C3%B3l-podmiotu)

Wymagane uprawnienia: `CredentialsManage`, `CredentialsRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/permissions/query/entities/roles" method="get" path="/api/v2/permissions/query/entities/roles" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->permissions->getEntityRoles(

);

if ($response->queryEntityRolesResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter               | Type                    | Required                | Description             |
| ----------------------- | ----------------------- | ----------------------- | ----------------------- |
| `pageOffset`            | *?int*                  | :heavy_minus_sign:      | Numer strony wyników.   |
| `pageSize`              | *?int*                  | :heavy_minus_sign:      | Rozmiar strony wyników. |

### Response

**[?Operations\GetApiV2PermissionsQueryEntitiesRolesResponse](../../Models/Operations/GetApiV2PermissionsQueryEntitiesRolesResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getSubordinateEntitiesRoles

Zwraca liste podmiotów podrzędnych.

> Więcej informacji:
> - [Pobieranie listy podmiotów podrzędnych](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-podmiot%C3%B3w-podrz%C4%99dnych)

Wymagane uprawnienia: `CredentialsManage`, `CredentialsRead`, `SubunitManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/query/subordinate-entities/roles" method="post" path="/api/v2/permissions/query/subordinate-entities/roles" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;
use Intermedia\Ksef\Apiv2\Models\Components;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$subordinateEntityRolesQueryRequest = new Components\SubordinateEntityRolesQueryRequest(
    subordinateEntityIdentifier: new Components\SubordinateEntityRolesQueryRequestSubordinateEntityIdentifier(
        type: Components\EntityPermissionsSubordinateEntityIdentifierType::Nip,
        value: '7762811692',
    ),
);

$response = $sdk->permissions->getSubordinateEntitiesRoles(
    subordinateEntityRolesQueryRequest: $subordinateEntityRolesQueryRequest
);

if ($response->querySubordinateEntityRolesResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                       | Type                                                                                                            | Required                                                                                                        | Description                                                                                                     |
| --------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                                    | *?int*                                                                                                          | :heavy_minus_sign:                                                                                              | Numer strony wyników.                                                                                           |
| `pageSize`                                                                                                      | *?int*                                                                                                          | :heavy_minus_sign:                                                                                              | Rozmiar strony wyników.                                                                                         |
| `subordinateEntityRolesQueryRequest`                                                                            | [?Components\SubordinateEntityRolesQueryRequest](../../Models/Components/SubordinateEntityRolesQueryRequest.md) | :heavy_minus_sign:                                                                                              | N/A                                                                                                             |

### Response

**[?Operations\PostApiV2PermissionsQuerySubordinateEntitiesRolesResponse](../../Models/Operations/PostApiV2PermissionsQuerySubordinateEntitiesRolesResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getAuthorizationsGrants

Zwraca listę uprawnień podmiotowych do obsługi faktur.

> Więcej informacji:
> - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-uprawnie%C5%84-podmiotowych-do-obs%C5%82ugi-faktur)

Wymagane uprawnienia: `CredentialsManage`, `CredentialsRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/query/authorizations/grants" method="post" path="/api/v2/permissions/query/authorizations/grants" -->
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

$requestBody = new Operations\PostApiV2PermissionsQueryAuthorizationsGrantsRequestBody(
    authorizedIdentifier: new Operations\PostApiV2PermissionsQueryAuthorizationsGrantsAuthorizedIdentifier(
        type: Components\EntityAuthorizationsAuthorizedEntityIdentifierType::Nip,
        value: '7762811692',
    ),
    queryType: Components\QueryType::Granted,
    permissionTypes: [
        Components\InvoicePermissionType::SelfInvoicing,
        Components\InvoicePermissionType::TaxRepresentative,
        Components\InvoicePermissionType::RRInvoicing,
    ],
);

$response = $sdk->permissions->getAuthorizationsGrants(
    requestBody: $requestBody
);

if ($response->queryEntityAuthorizationPermissionsResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                   | Type                                                                                                                                                        | Required                                                                                                                                                    | Description                                                                                                                                                 |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                                                                                | *?int*                                                                                                                                                      | :heavy_minus_sign:                                                                                                                                          | Numer strony wyników.                                                                                                                                       |
| `pageSize`                                                                                                                                                  | *?int*                                                                                                                                                      | :heavy_minus_sign:                                                                                                                                          | Rozmiar strony wyników.                                                                                                                                     |
| `requestBody`                                                                                                                                               | [?Operations\PostApiV2PermissionsQueryAuthorizationsGrantsRequestBody](../../Models/Operations/PostApiV2PermissionsQueryAuthorizationsGrantsRequestBody.md) | :heavy_minus_sign:                                                                                                                                          | N/A                                                                                                                                                         |

### Response

**[?Operations\PostApiV2PermissionsQueryAuthorizationsGrantsResponse](../../Models/Operations/PostApiV2PermissionsQueryAuthorizationsGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getEuEntityGrants

Zwraca listę uprawnień administratorów lub reprezentantów podmiotów unijnych uprawnionych do samofakturowania.

> Więcej informacji:
> - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-uprawnie%C5%84-administrator%C3%B3w-lub-reprezentant%C3%B3w-podmiot%C3%B3w-unijnych-uprawnionych-do-samofakturowania)

Wymagane uprawnienia: `CredentialsManage`, `CredentialsRead`, `VatUeManage`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/permissions/query/eu-entities/grants" method="post" path="/api/v2/permissions/query/eu-entities/grants" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;
use Intermedia\Ksef\Apiv2\Models\Components;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$euEntityPermissionsQueryRequest = new Components\EuEntityPermissionsQueryRequest(
    vatUeIdentifier: 'DE123456789012',
    permissionTypes: [
        Components\EuEntityPermissionsQueryPermissionType::VatUeManage,
        Components\EuEntityPermissionsQueryPermissionType::Introspection,
    ],
);

$response = $sdk->permissions->getEuEntityGrants(
    euEntityPermissionsQueryRequest: $euEntityPermissionsQueryRequest
);

if ($response->queryEuEntityPermissionsResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                 | Type                                                                                                      | Required                                                                                                  | Description                                                                                               |
| --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                              | *?int*                                                                                                    | :heavy_minus_sign:                                                                                        | Numer strony wyników.                                                                                     |
| `pageSize`                                                                                                | *?int*                                                                                                    | :heavy_minus_sign:                                                                                        | Rozmiar strony wyników.                                                                                   |
| `euEntityPermissionsQueryRequest`                                                                         | [?Components\EuEntityPermissionsQueryRequest](../../Models/Components/EuEntityPermissionsQueryRequest.md) | :heavy_minus_sign:                                                                                        | N/A                                                                                                       |

### Response

**[?Operations\PostApiV2PermissionsQueryEuEntitiesGrantsResponse](../../Models/Operations/PostApiV2PermissionsQueryEuEntitiesGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |