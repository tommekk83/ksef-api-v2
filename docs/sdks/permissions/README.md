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

<!-- UsageSnippet language="php" operationID="grantToPersons" method="post" path="/api/v2/permissions/persons/grants" -->
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

$request = new Operations\GrantToPersonsRequest(
    subjectIdentifier: new Operations\GrantToPersonsSubjectIdentifier(
        type: Components\PersonPermissionsSubjectIdentifierType::Pesel,
        value: '15062788702',
    ),
    permissions: [
        Components\PersonPermissionType::InvoiceRead,
        Components\PersonPermissionType::InvoiceWrite,
    ],
    description: 'praca w kontekście 5265877635; uprawniony PESEL: 15062788702, Adam Abacki',
);

$response = $sdk->permissions->grantToPersons(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                            | Type                                                                                 | Required                                                                             | Description                                                                          |
| ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ |
| `$request`                                                                           | [Operations\GrantToPersonsRequest](../../Models/Operations/GrantToPersonsRequest.md) | :heavy_check_mark:                                                                   | The request object to use for the request.                                           |

### Response

**[?Operations\GrantToPersonsResponse](../../Models/Operations/GrantToPersonsResponse.md)**

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

<!-- UsageSnippet language="php" operationID="grantToEntities" method="post" path="/api/v2/permissions/entities/grants" -->
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

$request = new Operations\GrantToEntitiesRequest(
    subjectIdentifier: new Operations\GrantToEntitiesSubjectIdentifier(
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
    description: 'praca w kontekście 5265877635; uprawniony NIP: 7762811692, Firma "FRM" Sp. z o.o.',
);

$response = $sdk->permissions->grantToEntities(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                              | Type                                                                                   | Required                                                                               | Description                                                                            |
| -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- |
| `$request`                                                                             | [Operations\GrantToEntitiesRequest](../../Models/Operations/GrantToEntitiesRequest.md) | :heavy_check_mark:                                                                     | The request object to use for the request.                                             |

### Response

**[?Operations\GrantToEntitiesResponse](../../Models/Operations/GrantToEntitiesResponse.md)**

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

<!-- UsageSnippet language="php" operationID="grantAuthorizations" method="post" path="/api/v2/permissions/authorizations/grants" -->
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

$request = new Operations\GrantAuthorizationsRequest(
    subjectIdentifier: new Operations\GrantAuthorizationsSubjectIdentifier(
        type: Components\EntityAuthorizationPermissionsSubjectIdentifierType::Nip,
        value: '7762811692',
    ),
    permission: Components\EntityAuthorizationPermissionType::SelfInvoicing,
    description: 'praca w kontekście 5265877635; uprawniony NIP: 7762811692, Firma "FRM" Sp. z o.o.',
);

$response = $sdk->permissions->grantAuthorizations(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                      | Type                                                                                           | Required                                                                                       | Description                                                                                    |
| ---------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------- |
| `$request`                                                                                     | [Operations\GrantAuthorizationsRequest](../../Models/Operations/GrantAuthorizationsRequest.md) | :heavy_check_mark:                                                                             | The request object to use for the request.                                                     |

### Response

**[?Operations\GrantAuthorizationsResponse](../../Models/Operations/GrantAuthorizationsResponse.md)**

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

<!-- UsageSnippet language="php" operationID="grantIndirectly" method="post" path="/api/v2/permissions/indirect/grants" -->
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

$request = new Operations\GrantIndirectlyRequest(
    subjectIdentifier: new Operations\GrantIndirectlySubjectIdentifier(
        type: Components\IndirectPermissionsSubjectIdentifierType::Pesel,
        value: '15062788702',
    ),
    targetIdentifier: new Operations\GrantIndirectlyTargetIdentifier(
        type: Components\IndirectPermissionsTargetIdentifierType::AllPartners,
    ),
    permissions: [
        Components\IndirectPermissionType::InvoiceWrite,
        Components\IndirectPermissionType::InvoiceRead,
    ],
    description: 'praca w kontekście 5265877635; uprawniony PESEL: 15062788702, Adam Abacki',
);

$response = $sdk->permissions->grantIndirectly(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                              | Type                                                                                   | Required                                                                               | Description                                                                            |
| -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- |
| `$request`                                                                             | [Operations\GrantIndirectlyRequest](../../Models/Operations/GrantIndirectlyRequest.md) | :heavy_check_mark:                                                                     | The request object to use for the request.                                             |

### Response

**[?Operations\GrantIndirectlyResponse](../../Models/Operations/GrantIndirectlyResponse.md)**

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

<!-- UsageSnippet language="php" operationID="grantToSubunits" method="post" path="/api/v2/permissions/subunits/grants" -->
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

$request = new Operations\GrantToSubunitsRequest(
    subjectIdentifier: new Operations\GrantToSubunitsSubjectIdentifier(
        type: Components\SubunitPermissionsSubjectIdentifierType::Pesel,
        value: '15062788702',
    ),
    contextIdentifier: new Operations\GrantToSubunitsContextIdentifier(
        type: Components\SubunitPermissionsContextIdentifierType::InternalId,
        value: '7762811692-11111',
    ),
    description: 'praca w kontekście 7762811692-11111; uprawniony PESEL: 15062788702, Adam Abacki',
    subunitName: 'Nazwa jednostki podrzędnej',
);

$response = $sdk->permissions->grantToSubunits(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                              | Type                                                                                   | Required                                                                               | Description                                                                            |
| -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- |
| `$request`                                                                             | [Operations\GrantToSubunitsRequest](../../Models/Operations/GrantToSubunitsRequest.md) | :heavy_check_mark:                                                                     | The request object to use for the request.                                             |

### Response

**[?Operations\GrantToSubunitsResponse](../../Models/Operations/GrantToSubunitsResponse.md)**

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

<!-- UsageSnippet language="php" operationID="grantRights" method="post" path="/api/v2/permissions/eu-entities/administration/grants" -->
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

$request = new Operations\GrantRightsRequest(
    subjectIdentifier: new Operations\GrantRightsSubjectIdentifier(
        type: Components\EuEntityAdministrationPermissionsSubjectIdentifierType::Fingerprint,
        value: 'CEB3643BAC2C111ADDE971BDA5A80163441867D65389FC0BC0DFF8B4C1CD4E59',
    ),
    contextIdentifier: new Operations\GrantRightsContextIdentifier(
        type: Components\EuEntityAdministrationPermissionsContextIdentifierType::NipVatUe,
        value: '7762811692-DE123456789012',
    ),
    description: 'praca w kontekście 7762811692-DE123456789012; uprawniony FP: CEB3643BAC2C111ADDE971BDA5A80163441867D65389FC0BC0DFF8B4C1CD4E59, Firma "FRM" Sp. z o.o.',
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

| Parameter                                                                      | Type                                                                           | Required                                                                       | Description                                                                    |
| ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ |
| `$request`                                                                     | [Operations\GrantRightsRequest](../../Models/Operations/GrantRightsRequest.md) | :heavy_check_mark:                                                             | The request object to use for the request.                                     |

### Response

**[?Operations\GrantRightsResponse](../../Models/Operations/GrantRightsResponse.md)**

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

<!-- UsageSnippet language="php" operationID="grantToEuEntities" method="post" path="/api/v2/permissions/eu-entities/grants" -->
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

$request = new Operations\GrantToEuEntitiesRequest(
    subjectIdentifier: new Operations\GrantToEuEntitiesSubjectIdentifier(
        type: Components\EuEntityPermissionsSubjectIdentifierType::Fingerprint,
        value: 'CEB3643BAC2C111ADDE971BDA5A80163441867D65389FC0BC0DFF8B4C1CD4E59',
    ),
    permissions: [
        Components\EuEntityPermissionType::InvoiceRead,
        Components\EuEntityPermissionType::InvoiceWrite,
    ],
    description: 'praca w kontekście 5194084033-IT932928602745; uprawniony FP: CEB3643BAC2C111ADDE971BDA5A80163441867D65389FC0BC0DFF8B4C1CD4E59, Hans Fisher; 10.02.1990; paszport AT: AP759478',
);

$response = $sdk->permissions->grantToEuEntities(
    request: $request
);

if ($response->permissionsOperationResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                  | Type                                                                                       | Required                                                                                   | Description                                                                                |
| ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ |
| `$request`                                                                                 | [Operations\GrantToEuEntitiesRequest](../../Models/Operations/GrantToEuEntitiesRequest.md) | :heavy_check_mark:                                                                         | The request object to use for the request.                                                 |

### Response

**[?Operations\GrantToEuEntitiesResponse](../../Models/Operations/GrantToEuEntitiesResponse.md)**

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

<!-- UsageSnippet language="php" operationID="revokePermissions" method="delete" path="/api/v2/permissions/common/grants/{permissionId}" -->
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

**[?Operations\RevokePermissionsResponse](../../Models/Operations/RevokePermissionsResponse.md)**

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

<!-- UsageSnippet language="php" operationID="revokeAuthorizations" method="delete" path="/api/v2/permissions/authorizations/grants/{permissionId}" -->
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

**[?Operations\RevokeAuthorizationsResponse](../../Models/Operations/RevokeAuthorizationsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getOperationStatus

Zwraca status operacji asynchronicznej związanej z nadaniem lub odebraniem uprawnień.

### Example Usage

<!-- UsageSnippet language="php" operationID="getOperationStatus" method="get" path="/api/v2/permissions/operations/{operationReferenceNumber}" -->
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

**[?Operations\GetOperationStatusResponse](../../Models/Operations/GetOperationStatusResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## checkAttachmentStatus

Sprawdzenie czy obecny kontekst posiada zgodę na wystawianie faktur z załącznikiem.

Wymagane uprawnienia: `CredentialsManage`, `CredentialsRead`.

### Example Usage

<!-- UsageSnippet language="php" operationID="checkAttachmentStatus" method="get" path="/api/v2/permissions/attachments/status" -->
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

**[?Operations\CheckAttachmentStatusResponse](../../Models/Operations/CheckAttachmentStatusResponse.md)**

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

<!-- UsageSnippet language="php" operationID="getPersonalGrants" method="post" path="/api/v2/permissions/query/personal/grants" -->
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

$personalPermissionsQueryRequest = new Components\PersonalPermissionsQueryRequest(
    contextIdentifier: new Components\PersonalPermissionsQueryRequestContextIdentifier(
        type: Components\PersonalPermissionsContextIdentifierType::Nip,
        value: '5265877635',
    ),
    targetIdentifier: new Components\PersonalPermissionsQueryRequestTargetIdentifier(
        type: Components\PersonalPermissionsTargetIdentifierType::Nip,
        value: '7762811692',
    ),
    permissionTypes: [
        Components\PersonalPermissionType::CredentialsManage,
    ],
    permissionState: Components\PersonalPermissionsQueryRequestPermissionState::Active,
);

$response = $sdk->permissions->getPersonalGrants(
    pageOffset: 0,
    pageSize: 10,
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

**[?Operations\GetPersonalGrantsResponse](../../Models/Operations/GetPersonalGrantsResponse.md)**

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

<!-- UsageSnippet language="php" operationID="getPersonGrants" method="post" path="/api/v2/permissions/query/persons/grants" -->
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

$requestBody = new Operations\GetPersonGrantsRequestBody(
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
    pageOffset: 0,
    pageSize: 10,
    requestBody: $requestBody

);

if ($response->queryPersonPermissionsResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                       | Type                                                                                            | Required                                                                                        | Description                                                                                     |
| ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                    | *?int*                                                                                          | :heavy_minus_sign:                                                                              | Numer strony wyników.                                                                           |
| `pageSize`                                                                                      | *?int*                                                                                          | :heavy_minus_sign:                                                                              | Rozmiar strony wyników.                                                                         |
| `requestBody`                                                                                   | [?Operations\GetPersonGrantsRequestBody](../../Models/Operations/GetPersonGrantsRequestBody.md) | :heavy_minus_sign:                                                                              | N/A                                                                                             |

### Response

**[?Operations\GetPersonGrantsResponse](../../Models/Operations/GetPersonGrantsResponse.md)**

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

<!-- UsageSnippet language="php" operationID="getSubunitsGrants" method="post" path="/api/v2/permissions/query/subunits/grants" -->
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
    pageOffset: 0,
    pageSize: 10,
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

**[?Operations\GetSubunitsGrantsResponse](../../Models/Operations/GetSubunitsGrantsResponse.md)**

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

<!-- UsageSnippet language="php" operationID="getEntityRoles" method="get" path="/api/v2/permissions/query/entities/roles" -->
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
    pageOffset: 0,
    pageSize: 10

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

**[?Operations\GetEntityRolesResponse](../../Models/Operations/GetEntityRolesResponse.md)**

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

<!-- UsageSnippet language="php" operationID="getSubordinateEntitiesRoles" method="post" path="/api/v2/permissions/query/subordinate-entities/roles" -->
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
    pageOffset: 0,
    pageSize: 10,
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

**[?Operations\GetSubordinateEntitiesRolesResponse](../../Models/Operations/GetSubordinateEntitiesRolesResponse.md)**

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

<!-- UsageSnippet language="php" operationID="getAuthorizationsGrants" method="post" path="/api/v2/permissions/query/authorizations/grants" -->
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

$requestBody = new Operations\GetAuthorizationsGrantsRequestBody(
    authorizedIdentifier: new Operations\GetAuthorizationsGrantsAuthorizedIdentifier(
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
    pageOffset: 0,
    pageSize: 10,
    requestBody: $requestBody

);

if ($response->queryEntityAuthorizationPermissionsResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                       | Type                                                                                                            | Required                                                                                                        | Description                                                                                                     |
| --------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- |
| `pageOffset`                                                                                                    | *?int*                                                                                                          | :heavy_minus_sign:                                                                                              | Numer strony wyników.                                                                                           |
| `pageSize`                                                                                                      | *?int*                                                                                                          | :heavy_minus_sign:                                                                                              | Rozmiar strony wyników.                                                                                         |
| `requestBody`                                                                                                   | [?Operations\GetAuthorizationsGrantsRequestBody](../../Models/Operations/GetAuthorizationsGrantsRequestBody.md) | :heavy_minus_sign:                                                                                              | N/A                                                                                                             |

### Response

**[?Operations\GetAuthorizationsGrantsResponse](../../Models/Operations/GetAuthorizationsGrantsResponse.md)**

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

<!-- UsageSnippet language="php" operationID="getEuEntityGrants" method="post" path="/api/v2/permissions/query/eu-entities/grants" -->
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
    pageOffset: 0,
    pageSize: 10,
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

**[?Operations\GetEuEntityGrantsResponse](../../Models/Operations/GetEuEntityGrantsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |