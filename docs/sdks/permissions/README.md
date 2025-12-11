# Permissions

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

Metoda pozwala na nadanie osobie wskazanej w żądaniu uprawnień do pracy w KSeF  
w kontekście bieżącym.
            
W żądaniu określane są nadawane uprawnienia ze zbioru:  
- **InvoiceWrite** – wystawianie faktur,  
- **InvoiceRead** – przeglądanie faktur,  
- **CredentialsManage** – zarządzanie uprawnieniami,  
- **CredentialsRead** – przeglądanie uprawnień,  
- **Introspection** – przeglądanie historii sesji i generowanie UPO,  
- **SubunitManage** – zarządzanie jednostkami podrzędnymi,  
- **EnforcementOperations** – wykonywanie operacji egzekucyjnych.
            
Metoda pozwala na wybór dowolnej kombinacji powyższych uprawnień.  
Uprawnienie **EnforcementOperations** może być nadane wyłącznie wtedy,  
gdy podmiot kontekstu ma rolę **EnforcementAuthority** (organ egzekucyjny)  
lub **CourtBailiff** (komornik sądowy).

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadawanie-uprawnie%C5%84-osobom-fizycznym-do-pracy-w-ksef)

**Wymagane uprawnienia**: `CredentialsManage`.

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
        Components\PersonPermissionType::Introspection,
        Components\PersonPermissionType::CredentialsRead,
    ],
    description: 'Opis uprawnienia',
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

Metoda pozwala na nadanie podmiotowi wskazanemu w żądaniu uprawnień do obsługi faktur podmiotu kontekstu.  
W żądaniu określane są nadawane uprawnienia ze zbioru:  
- **InvoiceWrite** – wystawianie faktur  
- **InvoiceRead** – przeglądanie faktur  
            
Metoda pozwala na wybór dowolnej kombinacji powyższych uprawnień.  
Dla każdego uprawnienia może być ustawiona flaga **canDelegate**, mówiąca o możliwości jego dalszego przekazywania poprzez nadawanie w sposób pośredni.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-podmiotom-uprawnie%C5%84-do-obs%C5%82ugi-faktur)

**Wymagane uprawnienia**: `CredentialsManage`.

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
    description: 'Opis uprawnienia',
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

Metoda pozwala na nadanie jednego z uprawnień podmiotowych do obsługi podmiotu kontekstu  podmiotowi wskazanemu w żądaniu.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-podmiotowych)

**Wymagane uprawnienia**: `CredentialsManage`.

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
    description: 'działanie w imieniu 3393244202 w kontekście 7762811692, Firma sp. z o.o.',
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

Metoda pozwala na nadanie w sposób pośredni osobie wskazanej w żądaniu uprawnień do obsługi faktur innego podmiotu – klienta.  
Może to być jedna z możliwości:  
- nadanie uprawnień generalnych – do obsługi wszystkich klientów  
- nadanie uprawnień selektywnych – do obsługi wskazanego klienta  
            
Uprawnienie selektywne może być nadane wyłącznie wtedy, gdy klient nadał wcześniej podmiotowi bieżącego kontekstu dowolne uprawnienie z prawem do jego dalszego przekazywania (patrz [POST /api/v2/permissions/entities/grants](/docs/v2/index.html#tag/Nadawanie-uprawnien/paths/~1api~1v2~1permissions~1entities~1grants/post)).  
            
W żądaniu określane są nadawane uprawnienia ze zbioru:  
- **InvoiceWrite** – wystawianie faktur  
- **InvoiceRead** – przeglądanie faktur  
            
Metoda pozwala na wybór dowolnej kombinacji powyższych uprawnień.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-w-spos%C3%B3b-po%C5%9Bredni)

**Wymagane uprawnienia**: `CredentialsManage`.

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
        value: '22271569167',
    ),
    targetIdentifier: new Operations\GrantIndirectlyTargetIdentifier(
        type: Components\IndirectPermissionsTargetIdentifierType::Nip,
        value: '5687926712',
    ),
    permissions: [
        Components\IndirectPermissionType::InvoiceWrite,
        Components\IndirectPermissionType::InvoiceRead,
    ],
    description: 'praca dla klienta 5687926712; uprawniony PESEL: 22271569167, Adam Abacki; pośrednik 3936518395',
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

Metoda pozwala na nadanie wskazanemu w żądaniu podmiotowi lub osobie fizycznej uprawnień administratora w kontekście:  
- wskazanego NIP podmiotu podrzędnego – wyłącznie jeżeli podmiot bieżącego kontekstu logowania ma rolę podmiotu nadrzędnego:
  - **LocalGovernmentUnit** 
  - **VatGroupUnit**  
- wskazanego lub utworzonego identyfikatora wewnętrznego  
            
Wraz z utworzeniem administratora jednostki podrzędnej tworzony jest identyfikator wewnętrzny składający się z numeru NIP podmiotu kontekstu logowania oraz 5 cyfr unikalnie identyfikujących jednostkę wewnętrzną.  
W żądaniu podaje się również nazwę tej jednostki.  
            
Uprawnienia administratora jednostki podrzędnej obejmują:  
- **CredentialsManage** – zarządzanie uprawnieniami  
            
Metoda automatycznie nadaje powyższe uprawnienie, bez konieczności podawania go w żądaniu.
            
> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-administratora-podmiotu-podrz%C4%99dnego)

**Wymagane uprawnienia**: `SubunitManage`.

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
        value: '7762811692-12345',
    ),
    description: 'Opis uprawnienia',
    subunitName: 'Jednostka 014',
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

Metoda pozwala na nadanie wskazanemu w żądaniu podmiotowi lub osobie fizycznej uprawnień administratora w kontekście złożonym z identyfikatora NIP podmiotu kontekstu bieżącego oraz numeru VAT UE podmiotu unijnego wskazanego w żądaniu.  
Wraz z utworzeniem administratora podmiotu unijnego tworzony jest kontekst złożony składający się z numeru NIP podmiotu kontekstu logowania oraz wskazanego numeru identyfikacyjnego VAT UE podmiotu unijnego.  
W żądaniu podaje się również nazwę i adres podmiotu unijnego.  
            
Jedynym sposobem identyfikacji uprawnianego jest odcisk palca certyfikatu kwalifikowanego:  
- certyfikat podpisu elektronicznego dla osób fizycznych  
- certyfikat pieczęci elektronicznej dla podmiotów  
            
Uprawnienia administratora podmiotu unijnego obejmują:  
- **VatEuManage** – zarządzanie uprawnieniami w ramach podmiotu unijnego  
- **InvoiceWrite** – wystawianie faktur  
- **InvoiceRead** – przeglądanie faktur  
- **Introspection** – przeglądanie historii sesji  
            
Metoda automatycznie nadaje wszystkie powyższe uprawnienia, bez konieczności ich wskazywania w żądaniu.
            
> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-administratora-podmiotu-unijnego)

**Wymagane uprawnienia**: `CredentialsManage`.

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
    description: 'Opis uprawnienia',
    euEntityName: 'Firma G.m.b.H.',
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

Metoda pozwala na nadanie wskazanemu w żądaniu podmiotowi lub osobie fizycznej uprawnień do wystawiania i/lub przeglądania faktur w kontekście złożonym kontekstu bieżącego.  
            
Jedynym sposobem identyfikacji uprawnianego jest odcisk palca certyfikatu kwalifikowanego:  
- certyfikat podpisu elektronicznego dla osób fizycznych  
- certyfikat pieczęci elektronicznej dla podmiotów  
            
W żądaniu określane są nadawane uprawnienia ze zbioru:  
- **InvoiceWrite** – wystawianie faktur  
- **InvoiceRead** – przeglądanie faktur  
            
Metoda pozwala na wybór dowolnej kombinacji powyższych uprawnień.

> Więcej informacji:
> - [Nadawanie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#nadanie-uprawnie%C5%84-reprezentanta-podmiotu-unijnego)

**Wymagane uprawnienia**: `VatUeManage`.

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
    description: 'Opis uprawnienia',
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

Metoda pozwala na odebranie uprawnienia o wskazanym identyfikatorze.  
Wymagane jest wcześniejsze odczytanie uprawnień w celu uzyskania  
identyfikatora uprawnienia, które ma zostać odebrane.

> Więcej informacji:
> - [Odbieranie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#odebranie-uprawnie%C5%84)

**Wymagane uprawnienia**: `CredentialsManage`, `VatUeManage`, `SubunitManage`.

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

Metoda pozwala na odebranie uprawnienia podmiotowego o wskazanym identyfikatorze.  
Wymagane jest wcześniejsze odczytanie uprawnień w celu uzyskania  
identyfikatora uprawnienia, które ma zostać odebrane.
            
> Więcej informacji:
> - [Odbieranie uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#odebranie-uprawnie%C5%84-podmiotowych)

**Wymagane uprawnienia**: `CredentialsManage`.

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

<!-- UsageSnippet language="php" operationID="getOperationStatus" method="get" path="/api/v2/permissions/operations/{referenceNumber}" -->
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
    referenceNumber: '<value>'
);

if ($response->permissionsOperationStatusResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                     | Type                                                          | Required                                                      | Description                                                   |
| ------------------------------------------------------------- | ------------------------------------------------------------- | ------------------------------------------------------------- | ------------------------------------------------------------- |
| `referenceNumber`                                             | *string*                                                      | :heavy_check_mark:                                            | Numer referencyjny operacji nadania lub odbierania uprawnień. |

### Response

**[?Operations\GetOperationStatusResponse](../../Models/Operations/GetOperationStatusResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## checkAttachmentStatus

Sprawdzenie czy obecny kontekst posiada zgodę na wystawianie faktur z załącznikiem.

**Wymagane uprawnienia**: `CredentialsManage`, `CredentialsRead`.

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

 Metoda pozwala na odczytanie własnych uprawnień uwierzytelnionego klienta API w bieżącym kontekście logowania.  

 W odpowiedzi przekazywane są następujące uprawnienia:  
 - nadane w sposób bezpośredni w bieżącym kontekście  
 - nadane przez podmiot nadrzędny  
 - nadane w sposób pośredni, jeżeli podmiot kontekstu logowania jest w uprawnieniu pośrednikiem lub podmiotem docelowym  
 - nadane podmiotowi do obsługi faktur przez inny podmiot, jeśli podmiot uwierzytelniony ma w bieżącym kontekście uprawnienia właścicielskie  

 Uprawnienia zwracane przez operację obejmują:  
 - **CredentialsManage** – zarządzanie uprawnieniami  
 - **CredentialsRead** – przeglądanie uprawnień  
 - **InvoiceWrite** – wystawianie faktur  
 - **InvoiceRead** – przeglądanie faktur  
 - **Introspection** – przeglądanie historii sesji  
 - **SubunitManage** – zarządzanie podmiotami podrzędnymi  
 - **EnforcementOperations** – wykonywanie operacji egzekucyjnych  
 - **VatEuManage** – zarządzanie uprawnieniami w ramach podmiotu unijnego  

 Odpowiedź może być filtrowana na podstawie następujących parametrów:  
 - **contextIdentifier** – identyfikator podmiotu, który nadał uprawnienie do obsługi faktur  
 - **targetIdentifier** – identyfikator podmiotu docelowego dla uprawnień nadanych pośrednio  
 - **permissionTypes** – lista rodzajów wyszukiwanych uprawnień  
 - **permissionState** – status uprawnienia  

#### Stronicowanie wyników
Zapytanie zwraca **jedną stronę wyników** o numerze i rozmiarze podanym w ścieżce.
- Przy pierwszym wywołaniu należy ustawić parametr `pageOffset = 0`.  
- Jeżeli dostępna jest kolejna strona wyników, w odpowiedzi pojawi się flaga **`hasMore`**.  
- W takim przypadku można wywołać zapytanie ponownie z kolejnym numerem strony.

 > Więcej informacji:
 > - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-w%C5%82asnych-uprawnie%C5%84)

**Sortowanie:**

- startDate (Desc)



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
        value: '3568707925',
    ),
    permissionTypes: [
        Components\PersonalPermissionType::InvoiceWrite,
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

 Metoda pozwala na odczytanie uprawnień nadanych osobie fizycznej lub podmiotowi.  
 Lista pobranych uprawnień może być dwóch rodzajów:  
 - Lista wszystkich uprawnień obowiązujących w bieżącym kontekście logowania (używana, gdy administrator chce przejrzeć uprawnienia wszystkich użytkowników w bieżącym kontekście)  
 - Lista wszystkich uprawnień nadanych w bieżącym kontekście przez uwierzytelnionego klienta API (używana, gdy administrator chce przejrzeć listę nadanych przez siebie uprawnień w bieżącym kontekście)  

 Dla pierwszej listy (obowiązujących uprawnień) w odpowiedzi przekazywane są:  
 - osoby i podmioty mogące pracować w bieżącym kontekście z wyjątkiem osób uprawnionych w sposób pośredni  
 - osoby uprawnione w sposób pośredni przez podmiot bieżącego kontekstu  

 Dla drugiej listy (nadanych uprawnień) w odpowiedzi przekazywane są:  
 - uprawnienia nadane w sposób bezpośredni do pracy w bieżącym kontekście lub w kontekście jednostek podrzędnych  
 - uprawnienia nadane w sposób pośredni do obsługi klientów podmiotu bieżącego kontekstu  

 Uprawnienia zwracane przez operację obejmują:  
 - **CredentialsManage** – zarządzanie uprawnieniami  
 - **CredentialsRead** – przeglądanie uprawnień  
 - **InvoiceWrite** – wystawianie faktur  
 - **InvoiceRead** – przeglądanie faktur  
 - **Introspection** – przeglądanie historii sesji  
 - **SubunitManage** – zarządzanie podmiotami podrzędnymi  
 - **EnforcementOperations** – wykonywanie operacji egzekucyjnych  

 Odpowiedź może być filtrowana na podstawie parametrów:  
 - **authorIdentifier** – identyfikator osoby, która nadała uprawnienie  
 - **authorizedIdentifier** – identyfikator osoby lub podmiotu uprawnionego  
 - **targetIdentifier** – identyfikator podmiotu docelowego dla uprawnień nadanych pośrednio  
 - **permissionTypes** – lista rodzajów wyszukiwanych uprawnień  
 - **permissionState** – status uprawnienia  
 - **queryType** – typ zapytania określający, która z dwóch list ma zostać zwrócona  

#### Stronicowanie wyników
Zapytanie zwraca **jedną stronę wyników** o numerze i rozmiarze podanym w ścieżce.
- Przy pierwszym wywołaniu należy ustawić parametr `pageOffset = 0`.  
- Jeżeli dostępna jest kolejna strona wyników, w odpowiedzi pojawi się flaga **`hasMore`**.  
- W takim przypadku można wywołać zapytanie ponownie z kolejnym numerem strony.

 > Więcej informacji:
 > - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-uprawnie%C5%84-do-pracy-w-ksef-nadanych-osobom-fizycznym-lub-podmiotom)

**Sortowanie:**

- startDate (Desc)



**Wymagane uprawnienia**: `CredentialsManage`, `CredentialsRead`, `SubunitManage`.

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

 Metoda pozwala na odczytanie uprawnień do zarządzania uprawnieniami nadanych administratorom:  
 - jednostek podrzędnych identyfikowanych identyfikatorem wewnętrznym  
 - podmiotów podrzędnych (podrzędnych JST lub członków grupy VAT) identyfikowanych przez NIP  

 Lista zwraca wyłącznie uprawnienia do zarządzania uprawnieniami nadane z kontekstu bieżącego (z podmiotu nadrzędnego).  
 Nie są odczytywane uprawnienia nadane przez administratorów jednostek podrzędnych wewnątrz tych jednostek.  

 Odpowiedź może być filtrowana na podstawie parametru:  
 - **subunitIdentifier** – identyfikator jednostki lub podmiotu podrzędnego  

#### Stronicowanie wyników
Zapytanie zwraca **jedną stronę wyników** o numerze i rozmiarze podanym w ścieżce.
- Przy pierwszym wywołaniu należy ustawić parametr `pageOffset = 0`.  
- Jeżeli dostępna jest kolejna strona wyników, w odpowiedzi pojawi się flaga **`hasMore`**.  
- W takim przypadku można wywołać zapytanie ponownie z kolejnym numerem strony.

 > Więcej informacji:
 > - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-uprawnie%C5%84-administrator%C3%B3w-jednostek-i-podmiot%C3%B3w-podrz%C4%99dnych)

**Sortowanie:**

- startDate (Desc)



**Wymagane uprawnienia**: `CredentialsManage`, `CredentialsRead`, `SubunitManage`.

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

 Metoda pozwala na **odczytanie listy ról podmiotu bieżącego kontekstu logowania**.

#### Role podmiotów zwracane przez operację:
- **CourtBailiff** – komornik sądowy  
- **EnforcementAuthority** – organ egzekucyjny  
- **LocalGovernmentUnit** – nadrzędna JST  
- **LocalGovernmentSubUnit** – podrzędne JST  
- **VatGroupUnit** – grupa VAT  
- **VatGroupSubUnit** – członek grupy VAT

#### Stronicowanie wyników
Zapytanie zwraca **jedną stronę wyników** o numerze i rozmiarze podanym w ścieżce.
- Przy pierwszym wywołaniu należy ustawić parametr `pageOffset = 0`.  
- Jeżeli dostępna jest kolejna strona wyników, w odpowiedzi pojawi się flaga **`hasMore`**.  
- W takim przypadku można wywołać zapytanie ponownie z kolejnym numerem strony.
 
 > Więcej informacji:
 > - [Pobieranie listy ról](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-r%C3%B3l-podmiotu)

**Sortowanie:**

- startDate (Desc)



**Wymagane uprawnienia**: `CredentialsManage`, `CredentialsRead`.

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

 Metoda pozwala na odczytanie listy podmiotów podrzędnych,  
 jeżeli podmiot bieżącego kontekstu ma rolę podmiotu nadrzędnego:
 - **nadrzędna JST** – odczytywane są podrzędne JST,  
 - **grupa VAT** – odczytywane są podmioty będące członkami grupy VAT.

 Role podmiotów zwracane przez operację obejmują:  
 - **LocalGovernmentSubUnit** – podrzędne JST,  
 - **VatGroupSubUnit** – członek grupy VAT.

 Odpowiedź może być filtrowana według parametru:  
 - **subordinateEntityIdentifier** – identyfikator podmiotu podrzędnego.

#### Stronicowanie wyników
Zapytanie zwraca **jedną stronę wyników** o numerze i rozmiarze podanym w ścieżce.
- Przy pierwszym wywołaniu należy ustawić parametr `pageOffset = 0`.  
- Jeżeli dostępna jest kolejna strona wyników, w odpowiedzi pojawi się flaga **`hasMore`**.  
- W takim przypadku można wywołać zapytanie ponownie z kolejnym numerem strony.
  
 > Więcej informacji:
 > - [Pobieranie listy podmiotów podrzędnych](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-podmiot%C3%B3w-podrz%C4%99dnych)

**Sortowanie:**

- startDate (Desc)



**Wymagane uprawnienia**: `CredentialsManage`, `CredentialsRead`, `SubunitManage`.

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

 Metoda pozwala na odczytanie uprawnień podmiotowych:  
 - otrzymanych przez podmiot bieżącego kontekstu  
 - nadanych przez podmiot bieżącego kontekstu  

 Wybór listy nadanych lub otrzymanych uprawnień odbywa się przy użyciu parametru **queryType**.  

 Uprawnienia zwracane przez operację obejmują:  
 - **SelfInvoicing** – wystawianie faktur w trybie samofakturowania  
 - **TaxRepresentative** – wykonywanie operacji przedstawiciela podatkowego  
 - **RRInvoicing** – wystawianie faktur VAT RR  
 - **PefInvoicing** – wystawianie faktur PEF  

 Odpowiedź może być filtrowana na podstawie następujących parametrów:  
 - **authorizingIdentifier** – identyfikator podmiotu uprawniającego (stosowane przy queryType = Received)  
 - **authorizedIdentifier** – identyfikator podmiotu uprawnionego (stosowane przy queryType = Granted)  
 - **permissionTypes** – lista rodzajów wyszukiwanych uprawnień  

#### Stronicowanie wyników
Zapytanie zwraca **jedną stronę wyników** o numerze i rozmiarze podanym w ścieżce.
- Przy pierwszym wywołaniu należy ustawić parametr `pageOffset = 0`.  
- Jeżeli dostępna jest kolejna strona wyników, w odpowiedzi pojawi się flaga **`hasMore`**.  
- W takim przypadku można wywołać zapytanie ponownie z kolejnym numerem strony.

 > Więcej informacji:
 > - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-uprawnie%C5%84-podmiotowych-do-obs%C5%82ugi-faktur)

**Sortowanie:**

- startDate (Desc)



**Wymagane uprawnienia**: `CredentialsManage`, `CredentialsRead`, `PefInvoiceWrite`.

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

 Metoda pozwala na odczytanie uprawnień administratorów lub reprezentantów podmiotów unijnych:  
 - Jeżeli kontekstem logowania jest NIP, możliwe jest odczytanie uprawnień administratorów podmiotów unijnych powiązanych z podmiotem bieżącego kontekstu, czyli takich, dla których pierwszy człon kontekstu złożonego jest równy NIP-owi kontekstu logowania.  
 - Jeżeli kontekst logowania jest złożony (NIP-VAT UE), możliwe jest pobranie wszystkich uprawnień administratorów i reprezentantów podmiotu w bieżącym kontekście złożonym.  

 Uprawnienia zwracane przez operację obejmują:  
 - **VatUeManage** – zarządzanie uprawnieniami w ramach podmiotu unijnego  
 - **InvoiceWrite** – wystawianie faktur  
 - **InvoiceRead** – przeglądanie faktur  
 - **Introspection** – przeglądanie historii sesji  

 Odpowiedź może być filtrowana na podstawie następujących parametrów:  
 - **vatUeIdentifier** – identyfikator podmiotu unijnego  
 - **authorizedFingerprintIdentifier** – odcisk palca certyfikatu uprawnionej osoby lub podmiotu  
 - **permissionTypes** – lista rodzajów wyszukiwanych uprawnień  

#### Stronicowanie wyników
Zapytanie zwraca **jedną stronę wyników** o numerze i rozmiarze podanym w ścieżce.
- Przy pierwszym wywołaniu należy ustawić parametr `pageOffset = 0`.  
- Jeżeli dostępna jest kolejna strona wyników, w odpowiedzi pojawi się flaga **`hasMore`**.  
- W takim przypadku można wywołać zapytanie ponownie z kolejnym numerem strony.
 
 > Więcej informacji:
 > - [Pobieranie listy uprawnień](https://github.com/CIRFMF/ksef-docs/blob/main/uprawnienia.md#pobranie-listy-uprawnie%C5%84-administrator%C3%B3w-lub-reprezentant%C3%B3w-podmiot%C3%B3w-unijnych-uprawnionych-do-samofakturowania)

**Sortowanie:**

- startDate (Desc)



**Wymagane uprawnienia**: `CredentialsManage`, `CredentialsRead`, `VatUeManage`.

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