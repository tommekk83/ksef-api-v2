# intermedia/ksef-api-v2

Developer-friendly & type-safe Php SDK specifically catered to leverage *intermedia/ksef-api-v2* API.

<div align="left">
    <a href="https://www.speakeasy.com/?utm_source=intermedia/ksef-api-v2&utm_campaign=php"><img src="https://www.speakeasy.com/assets/badges/built-by-speakeasy.svg" /></a>
    <a href="https://opensource.org/licenses/MIT">
        <img src="https://img.shields.io/badge/License-MIT-blue.svg" style="width: 100px; height: 28px;" />
    </a>
</div>

<!-- Start Summary [summary] -->
## Summary

KSeF API TE: **Wersja API:** 2.0.0 (build 2.0.0-rc5.2-te-20251007.1+e79581180c86686f01304d52388f584305f14cc2)<br>
**Klucze publiczne** Ministerstwa Finansów (dla danego środowiska): [Pobierz klucze](#tag/Certyfikaty-klucza-publicznego)<br>
**Historia zmian:** [Changelog](https://github.com/CIRFMF/ksef-docs/blob/main/api-changelog.md)<br>
**Rozszerzona dokumentacja API:** [ksef-docs](https://github.com/CIRFMF/ksef-docs/tree/main)
<!-- End Summary [summary] -->

<!-- Start Table of Contents [toc] -->
## Table of Contents
<!-- $toc-max-depth=2 -->
* [intermedia/ksef-api-v2](#intermediaksef-api-v2)
  * [SDK Installation](#sdk-installation)
  * [SDK Example Usage](#sdk-example-usage)
  * [Authentication](#authentication)
  * [Available Resources and Operations](#available-resources-and-operations)
  * [Error Handling](#error-handling)
  * [Server Selection](#server-selection)
* [Development](#development)
  * [Maturity](#maturity)
  * [Contributions](#contributions)

<!-- End Table of Contents [toc] -->

<!-- Start SDK Installation [installation] -->
## SDK Installation

The SDK relies on [Composer](https://getcomposer.org/) to manage its dependencies.

To install the SDK and add it as a dependency to an existing `composer.json` file:
```bash
composer require "intermedia/ksef-api-v2"
```
<!-- End SDK Installation [installation] -->

<!-- Start SDK Example Usage [usage] -->
## SDK Example Usage

### Example

```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->getCurrentSessions(
    pageSize: 10
);

if ($response->authenticationListResponse !== null) {
    // handle response
}
```
<!-- End SDK Example Usage [usage] -->
### AuthTokenRequest XML generation with XAdES signature example

```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2\AuthTokenRequest;
use Intermedia\Ksef\Apiv2\Models\Components\{TContextIdentifier, TNip, SubjectIdentifierTypeEnum};

$req = new AuthTokenRequest(
    '20250625-CR-20F5EE4000-DA48AE4124-46',
    TContextIdentifier::fromNip(new TNip('5265877635')),
    SubjectIdentifierTypeEnum::CERTIFICATE_SUBJECT
);

// PEM Signature (private key and public certificate in separate files)
$signedXml = $req->signWithXadesToString('/path/to/private.pem', '/path/to/cert.pem');

// or PKCS#12 (private key and public certificate in one .p12 file)
$signedXml = $req->signWithXadesToString('/path/to/cert.p12', null, 'password_to_p12');
```
<!-- Start Authentication [security] -->
## Authentication

### Per-Client Security Schemes

This SDK supports the following security scheme globally:

| Name     | Type | Scheme      |
| -------- | ---- | ----------- |
| `bearer` | http | HTTP Bearer |

To authenticate with the API the `bearer` parameter must be set when initializing the SDK. For example:
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->getCurrentSessions(
    pageSize: 10
);

if ($response->authenticationListResponse !== null) {
    // handle response
}
```
<!-- End Authentication [security] -->

<!-- Start Available Resources and Operations [operations] -->
## Available Resources and Operations

<details open>
<summary>Available methods</summary>

### [auth](docs/sdks/auth/README.md)

* [getCurrentSessions](docs/sdks/auth/README.md#getcurrentsessions) - Pobranie listy aktywnych sesji
* [revokeCurrentSession](docs/sdks/auth/README.md#revokecurrentsession) - Unieważnienie aktualnej sesji uwierzytelnienia
* [revokeSession](docs/sdks/auth/README.md#revokesession) - Unieważnienie sesji uwierzytelnienia
* [challenge](docs/sdks/auth/README.md#challenge) - Inicjalizacja uwierzytelnienia
* [withXades](docs/sdks/auth/README.md#withxades) - Uwierzytelnienie z wykorzystaniem podpisu XAdES
* [withKsefToken](docs/sdks/auth/README.md#withkseftoken) - Uwierzytelnienie z wykorzystaniem tokena KSeF
* [getStatus](docs/sdks/auth/README.md#getstatus) - Pobranie statusu uwierzytelniania
* [redeemToken](docs/sdks/auth/README.md#redeemtoken) - Pobranie tokenów dostępowych
* [refreshToken](docs/sdks/auth/README.md#refreshtoken) - Odświeżenie tokena dostępowego

### [certificates](docs/sdks/certificates/README.md)

* [getLimits](docs/sdks/certificates/README.md#getlimits) - Pobranie danych o limitach certyfikatów
* [getEnrollmentData](docs/sdks/certificates/README.md#getenrollmentdata) - Pobranie danych do wniosku certyfikacyjnego
* [processEnrollment](docs/sdks/certificates/README.md#processenrollment) - Wysyłka wniosku certyfikacyjnego
* [getEnrollmentStatus](docs/sdks/certificates/README.md#getenrollmentstatus) - Pobranie statusu przetwarzania wniosku certyfikacyjnego
* [retrieve](docs/sdks/certificates/README.md#retrieve) - Pobranie certyfikatu lub listy certyfikatów
* [revoke](docs/sdks/certificates/README.md#revoke) - Unieważnienie certyfikatu
* [getList](docs/sdks/certificates/README.md#getlist) - Pobranie listy metadanych certyfikatów

### [invoices](docs/sdks/invoices/README.md)

* [getByKsefNumber](docs/sdks/invoices/README.md#getbyksefnumber) - Pobranie faktury po numerze KSeF
* [getList](docs/sdks/invoices/README.md#getlist) - Pobranie listy metadanych faktur
* [export](docs/sdks/invoices/README.md#export) - Eksport paczki faktur
* [getExportStatus](docs/sdks/invoices/README.md#getexportstatus) - Pobranie statusu eksportu paczki faktur

### [limits](docs/sdks/limits/README.md)

* [getContext](docs/sdks/limits/README.md#getcontext) - Pobranie limitów dla bieżącego kontekstu
* [getSubject](docs/sdks/limits/README.md#getsubject) - Pobranie limitów dla bieżącego podmiotu
* [updateContextSession](docs/sdks/limits/README.md#updatecontextsession) - Zmiana limitów sesji dla bieżącego kontekstu
* [resetContextSession](docs/sdks/limits/README.md#resetcontextsession) - Przywrócenie domyślnych wartości limitów sesji dla bieżącego kontekstu
* [updateSubjectCertificate](docs/sdks/limits/README.md#updatesubjectcertificate) - Zmiana limitów certyfikatów dla bieżącego podmiotu
* [resetSubjectCertificate](docs/sdks/limits/README.md#resetsubjectcertificate) - Przywrócenie domyślnych wartości limitów certyfikatów dla bieżącego podmiotu

### [peppol](docs/sdks/peppol/README.md)

* [listProviders](docs/sdks/peppol/README.md#listproviders) - Pobranie listy dostawców usług Peppol

### [permissions](docs/sdks/permissions/README.md)

* [grantToPersons](docs/sdks/permissions/README.md#granttopersons) - Nadanie osobom fizycznym uprawnień do pracy w KSeF
* [grantToEntities](docs/sdks/permissions/README.md#granttoentities) - Nadanie podmiotom uprawnień do obsługi faktur
* [grantAuthorizations](docs/sdks/permissions/README.md#grantauthorizations) - Nadanie uprawnień podmiotowych
* [grantIndirectly](docs/sdks/permissions/README.md#grantindirectly) - Nadanie uprawnień w sposób pośredni
* [grantToSubunits](docs/sdks/permissions/README.md#granttosubunits) - Nadanie uprawnień administratora podmiotu podrzędnego
* [grantRights](docs/sdks/permissions/README.md#grantrights) - Nadanie uprawnień administratora podmiotu unijnego
* [grantToEuEntities](docs/sdks/permissions/README.md#granttoeuentities) - Nadanie uprawnień reprezentanta podmiotu unijnego
* [revoke](docs/sdks/permissions/README.md#revoke) - Odebranie uprawnień
* [revokeAuthorizations](docs/sdks/permissions/README.md#revokeauthorizations) - Odebranie uprawnień podmiotowych
* [getOperationStatus](docs/sdks/permissions/README.md#getoperationstatus) - Pobranie statusu operacji
* [checkAttachmentStatus](docs/sdks/permissions/README.md#checkattachmentstatus) - Sprawdzenie statusu zgody na wystawianie faktur z załącznikiem
* [getPersonalGrants](docs/sdks/permissions/README.md#getpersonalgrants) - Pobranie listy własnych uprawnień
* [getPersonGrants](docs/sdks/permissions/README.md#getpersongrants) - Pobranie listy uprawnień do pracy w KSeF nadanych osobom fizycznym lub podmiotom
* [getSubunitsGrants](docs/sdks/permissions/README.md#getsubunitsgrants) - Pobranie listy uprawnień administratorów jednostek i podmiotów podrzędnych
* [getEntityRoles](docs/sdks/permissions/README.md#getentityroles) - Pobranie listy ról podmiotu
* [getSubordinateEntitiesRoles](docs/sdks/permissions/README.md#getsubordinateentitiesroles) - Pobranie listy podmiotów podrzędnych
* [getAuthorizationsGrants](docs/sdks/permissions/README.md#getauthorizationsgrants) - Pobranie listy uprawnień podmiotowych do obsługi faktur
* [getEuEntityGrants](docs/sdks/permissions/README.md#geteuentitygrants) - Pobranie listy uprawnień administratorów lub reprezentantów podmiotów unijnych uprawnionych do samofakturowania

### [security](docs/sdks/security/README.md)

* [getPublicKeyCertificates](docs/sdks/security/README.md#getpublickeycertificates) - Pobranie certyfikatów

### [sessions](docs/sdks/sessions/README.md)

* [getList](docs/sdks/sessions/README.md#getlist) - Pobranie listy sesji
* [getStatus](docs/sdks/sessions/README.md#getstatus) - Pobranie statusu sesji
* [getUpo](docs/sdks/sessions/README.md#getupo) - Pobranie UPO dla sesji
* [openOnline](docs/sdks/sessions/README.md#openonline) - Otwarcie sesji interaktywnej
* [closeOnline](docs/sdks/sessions/README.md#closeonline) - Zamknięcie sesji interaktywnej
* [openBatch](docs/sdks/sessions/README.md#openbatch) - Otwarcie sesji wsadowej
* [closeBatch](docs/sdks/sessions/README.md#closebatch) - Zamknięcie sesji wsadowej

#### [sessions->invoices](docs/sdks/sessionsinvoices/README.md)

* [getList](docs/sdks/sessionsinvoices/README.md#getlist) - Pobranie faktur sesji
* [getStatus](docs/sdks/sessionsinvoices/README.md#getstatus) - Pobranie statusu faktury z sesji
* [getFailed](docs/sdks/sessionsinvoices/README.md#getfailed) - Pobranie niepoprawnie przetworzonych faktur sesji
* [getUpoByKsefNumber](docs/sdks/sessionsinvoices/README.md#getupobyksefnumber) - Pobranie UPO faktury z sesji na podstawie numeru KSeF
* [getUpo](docs/sdks/sessionsinvoices/README.md#getupo) - Pobranie UPO faktury z sesji na podstawie numeru referencyjnego faktury
* [sendOnline](docs/sdks/sessionsinvoices/README.md#sendonline) - Wysłanie faktury

### [testData](docs/sdks/testdata/README.md)

* [createSubject](docs/sdks/testdata/README.md#createsubject) - Utworzenie podmiotu
* [removeSubject](docs/sdks/testdata/README.md#removesubject) - Usunięcie podmiotu
* [createPerson](docs/sdks/testdata/README.md#createperson) - Utworzenie osoby fizycznej
* [removePerson](docs/sdks/testdata/README.md#removeperson) - Usunięcie osoby fizycznej
* [assignPermissions](docs/sdks/testdata/README.md#assignpermissions) - Nadanie uprawnień testowemu podmiotowi/osobie fizycznej
* [revokePermissions](docs/sdks/testdata/README.md#revokepermissions) - Odebranie uprawnień testowemu podmiotowi/osobie fizycznej
* [addAttachment](docs/sdks/testdata/README.md#addattachment) - Umożliwienie wysyłania faktur z załącznikiem
* [revokeAttachment](docs/sdks/testdata/README.md#revokeattachment) - Odebranie możliwości wysyłania faktur z załącznikiem

### [tokens](docs/sdks/tokens/README.md)

* [generate](docs/sdks/tokens/README.md#generate) - Wygenerowanie nowego tokena
* [getList](docs/sdks/tokens/README.md#getlist) - Pobranie listy wygenerowanych tokenów
* [getStatus](docs/sdks/tokens/README.md#getstatus) - Pobranie statusu tokena
* [revoke](docs/sdks/tokens/README.md#revoke) - Unieważnienie tokena

</details>
<!-- End Available Resources and Operations [operations] -->

<!-- Start Error Handling [errors] -->
## Error Handling

Handling errors in this SDK should largely match your expectations. All operations return a response object or throw an exception.

By default an API error will raise a `Errors\APIException` exception, which has the following properties:

| Property       | Type                                    | Description           |
|----------------|-----------------------------------------|-----------------------|
| `$message`     | *string*                                | The error message     |
| `$statusCode`  | *int*                                   | The HTTP status code  |
| `$rawResponse` | *?\Psr\Http\Message\ResponseInterface*  | The raw HTTP response |
| `$body`        | *string*                                | The response content  |

When custom error responses are specified for an operation, the SDK may also throw their associated exception. You can refer to respective *Errors* tables in SDK docs for more details on possible exception types for each operation. For example, the `getCurrentSessions` method throws the following exceptions:

| Error Type               | Status Code | Content Type     |
| ------------------------ | ----------- | ---------------- |
| Errors\ExceptionResponse | 400         | application/json |
| Errors\APIException      | 4XX, 5XX    | \*/\*            |

### Example

```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;
use Intermedia\Ksef\Apiv2\Models\Errors;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

try {
    $response = $sdk->auth->getCurrentSessions(
        pageSize: 10
    );

    if ($response->authenticationListResponse !== null) {
        // handle response
    }
} catch (Errors\ExceptionResponseThrowable $e) {
    // handle $e->$container data
    throw $e;
} catch (Errors\APIException $e) {
    // handle default exception
    throw $e;
}
```
<!-- End Error Handling [errors] -->

<!-- Start Server Selection [server] -->
## Server Selection

### Override Server URL Per-Client

The default server can be overridden globally using the `setServerUrl(string $serverUrl)` builder method when initializing the SDK client instance. For example:
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setServerURL('https://ksef-test.mf.gov.pl')
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->getCurrentSessions(
    pageSize: 10
);

if ($response->authenticationListResponse !== null) {
    // handle response
}
```
<!-- End Server Selection [server] -->

<!-- Placeholder for Future Speakeasy SDK Sections -->

# Development

## Maturity

This SDK is in beta, and there may be breaking changes between versions without a major version update. Therefore, we recommend pinning usage
to a specific package version. This way, you can install the same version each time without breaking changes unless you are intentionally
looking for the latest version.

## Contributions

While we value open-source contributions to this SDK, this library is generated programmatically. Any manual changes added to internal files will be overwritten on the next generation. 
We look forward to hearing your feedback. Feel free to open a PR or an issue with a proof of concept and we'll do our best to include it in a future release. 

### SDK Created by [Speakeasy](https://www.speakeasy.com/?utm_source=intermedia/ksef-api-v2&utm_campaign=php)
