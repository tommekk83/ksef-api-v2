# intermedia/ksef-api-v2

Developer-friendly & type-safe Php SDK specifically catered to leverage *intermedia/ksef-api-v2* API.

<div align="left">
    <a href="https://www.speakeasy.com/?utm_source=intermedia/ksef-api-v2&utm_campaign=php"><img src="https://www.speakeasy.com/assets/badges/built-by-speakeasy.svg" /></a>
    <a href="https://opensource.org/licenses/MIT">
        <img src="https://img.shields.io/badge/License-MIT-blue.svg" style="width: 100px; height: 28px;" />
    </a>
</div>


<br /><br />
> [!IMPORTANT]
> This SDK is not yet ready for production use. To complete setup please follow the steps outlined in your [workspace](https://app.speakeasy.com/org/intermedia/ksef-wpw). Delete this section before > publishing to a package manager.

<!-- Start Summary [summary] -->
## Summary

KSeF API TE: **Wersja API:** 2.0.0 (build 2.0.0-rc4-te-20250827.1+d4adf52dbfb92d635d0069cba24a52e1e3d67e03)<br>
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
* [Development](#development)
  * [Maturity](#maturity)
  * [Contributions](#contributions)

<!-- End Table of Contents [toc] -->

<!-- Start SDK Installation [installation] -->
## SDK Installation

> [!TIP]
> To finish publishing your SDK you must [run your first generation action](https://www.speakeasy.com/docs/github-setup#step-by-step-guide).


The SDK relies on [Composer](https://getcomposer.org/) to manage its dependencies.

To install the SDK first add the below to your `composer.json` file:

```json
{
    "repositories": [
        {
            "type": "github",
            "url": "<UNSET>.git"
        }
    ],
    "require": {
        "intermedia/ksef-api-v2": "*"
    }
}
```

Then run the following command:

```bash
composer update
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



$response = $sdk->auth->getSessions(
    pageSize: 10
);

if ($response->authenticationListResponse !== null) {
    // handle response
}
```
<!-- End SDK Example Usage [usage] -->

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



$response = $sdk->auth->getSessions(
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

* [getSessions](docs/sdks/auth/README.md#getsessions) - Pobranie listy aktywnych sesji
* [deleteCurrentSession](docs/sdks/auth/README.md#deletecurrentsession) - Unieważnienie aktualnej sesji uwierzytelnienia
* [initiate](docs/sdks/auth/README.md#initiate) - Inicjalizacja uwierzytelnienia
* [authenticateWithXades](docs/sdks/auth/README.md#authenticatewithxades) - Uwierzytelnienie z wykorzystaniem podpisu XAdES
* [ksefToken](docs/sdks/auth/README.md#kseftoken) - Uwierzytelnienie z wykorzystaniem tokena KSeF
* [getStatus](docs/sdks/auth/README.md#getstatus) - Pobranie statusu uwierzytelniania
* [redeemToken](docs/sdks/auth/README.md#redeemtoken) - Pobranie tokenów dostępowych
* [refreshToken](docs/sdks/auth/README.md#refreshtoken) - Odświeżenie tokena dostępowego

### [authSessions](docs/sdks/authsessions/README.md)

* [delete](docs/sdks/authsessions/README.md#delete) - Unieważnienie sesji uwierzytelnienia

### [certificates](docs/sdks/certificates/README.md)

* [getLimits](docs/sdks/certificates/README.md#getlimits) - Pobranie danych o limitach certyfikatów
* [getEnrollmentData](docs/sdks/certificates/README.md#getenrollmentdata) - Pobranie danych do wniosku certyfikacyjnego
* [processEnrollment](docs/sdks/certificates/README.md#processenrollment) - Wysyłka wniosku certyfikacyjnego
* [getEnrollmentStatus](docs/sdks/certificates/README.md#getenrollmentstatus) - Pobranie statusu przetwarzania wniosku certyfikacyjnego
* [revoke](docs/sdks/certificates/README.md#revoke) - Unieważnienie certyfikatu
* [query](docs/sdks/certificates/README.md#query) - Pobranie listy metadanych certyfikatów

### [certyfikaty](docs/sdks/certyfikaty/README.md)

* [retrieve](docs/sdks/certyfikaty/README.md#retrieve) - Pobranie certyfikatu lub listy certyfikatów


### [invoiceExports](docs/sdks/invoiceexports/README.md)

* [getStatus](docs/sdks/invoiceexports/README.md#getstatus) - [mock] Pobranie statusu eksportu paczki faktur

### [invoices](docs/sdks/invoices/README.md)

* [getByKsefNumber](docs/sdks/invoices/README.md#getbyksefnumber) - Pobranie faktury po numerze KSeF
* [queryMetadata](docs/sdks/invoices/README.md#querymetadata) - Pobranie listy metadanych faktur
* [export](docs/sdks/invoices/README.md#export) - [mock] Eksport paczki faktur
* [getFailed](docs/sdks/invoices/README.md#getfailed) - Pobranie niepoprawnie przetworzonych faktur sesji
* [getInvoiceUpoByKsef](docs/sdks/invoices/README.md#getinvoiceupobyksef) - Pobranie UPO faktury z sesji na podstawie numeru KSeF
* [getInvoiceUpo](docs/sdks/invoices/README.md#getinvoiceupo) - Pobranie UPO faktury z sesji na podstawie numeru referencyjnego faktury

### [onlineSessionInvoices](docs/sdks/onlinesessioninvoices/README.md)

* [send](docs/sdks/onlinesessioninvoices/README.md#send) - Wysłanie faktury

### [permissions](docs/sdks/permissions/README.md)

* [grantToPersons](docs/sdks/permissions/README.md#granttopersons) - Nadanie osobom fizycznym uprawnień do pracy w KSeF
* [grantToEntities](docs/sdks/permissions/README.md#granttoentities) - Nadanie podmiotom uprawnień do obsługi faktur
* [grantSubjectAuthorization](docs/sdks/permissions/README.md#grantsubjectauthorization) - Nadanie uprawnień podmiotowych
* [grantIndirectly](docs/sdks/permissions/README.md#grantindirectly) - Nadanie uprawnień w sposób pośredni
* [grantToSubunits](docs/sdks/permissions/README.md#granttosubunits) - Nadanie uprawnień administratora podmiotu podrzędnego
* [grantAdminRights](docs/sdks/permissions/README.md#grantadminrights) - Nadanie uprawnień administratora podmiotu unijnego
* [grantToEuEntities](docs/sdks/permissions/README.md#granttoeuentities) - Nadanie uprawnień reprezentanta podmiotu unijnego
* [deleteGrant](docs/sdks/permissions/README.md#deletegrant) - Odebranie uprawnień
* [getOperationStatus](docs/sdks/permissions/README.md#getoperationstatus) - Pobranie statusu operacji
* [getPersonGrants](docs/sdks/permissions/README.md#getpersongrants) - Pobranie listy uprawnień do pracy w KSeF nadanych osobom fizycznym lub podmiotom
* [querySubunitsGrants](docs/sdks/permissions/README.md#querysubunitsgrants) - Pobranie listy uprawnień administratorów jednostek i podmiotów podrzędnych
* [getEntityRoles](docs/sdks/permissions/README.md#getentityroles) - Pobranie listy ról podmiotu
* [getSubordinateRoles](docs/sdks/permissions/README.md#getsubordinateroles) - Pobranie listy podmiotów podrzędnych
* [queryAuthorizationsGrants](docs/sdks/permissions/README.md#queryauthorizationsgrants) - Pobranie listy uprawnień podmiotowych do obsługi faktur
* [getEuEntityGrants](docs/sdks/permissions/README.md#geteuentitygrants) - Pobranie listy uprawnień administratorów lub reprezentantów podmiotów unijnych uprawnionych do samofakturowania

#### [permissions->authorizations](docs/sdks/authorizations/README.md)

* [revoke](docs/sdks/authorizations/README.md#revoke) - Odebranie uprawnień podmiotowych

### [publicKeyCertificates](docs/sdks/publickeycertificates/README.md)

* [get](docs/sdks/publickeycertificates/README.md#get) - Pobranie certyfikatów

### [sessionInvoices](docs/sdks/sessioninvoices/README.md)

* [list](docs/sdks/sessioninvoices/README.md#list) - Pobranie faktur sesji
* [getStatus](docs/sdks/sessioninvoices/README.md#getstatus) - Pobranie statusu faktury z sesji

### [sessions](docs/sdks/sessions/README.md)

* [list](docs/sdks/sessions/README.md#list) - Pobranie listy sesji
* [getStatus](docs/sdks/sessions/README.md#getstatus) - Pobranie statusu sesji
* [getUpo](docs/sdks/sessions/README.md#getupo) - Pobranie UPO dla sesji
* [openOnline](docs/sdks/sessions/README.md#openonline) - Otwarcie sesji interaktywnej
* [closeOnline](docs/sdks/sessions/README.md#closeonline) - Zamknięcie sesji interaktywnej
* [closeBatch](docs/sdks/sessions/README.md#closebatch) - Zamknięcie sesji wsadowej

### [sessionsBatch](docs/sdks/sessionsbatch/README.md)

* [open](docs/sdks/sessionsbatch/README.md#open) - Otwarcie sesji wsadowej

### [testdata](docs/sdks/testdata2/README.md)

* [createPerson](docs/sdks/testdata2/README.md#createperson) - Utworzenie osoby fizycznej
* [assignPermissions](docs/sdks/testdata2/README.md#assignpermissions) - Nadanie uprawnień testowemu podmiotowi/osobie fizycznej
* [addAttachment](docs/sdks/testdata2/README.md#addattachment) - Umożliwienie wysyłania faktur z załącznikiem

### [testData](docs/sdks/testdata1/README.md)

* [createSubject](docs/sdks/testdata1/README.md#createsubject) - Utworzenie podmiotu
* [removeSubject](docs/sdks/testdata1/README.md#removesubject) - Usunięcie podmiotu
* [removePerson](docs/sdks/testdata1/README.md#removeperson) - Usunięcie osoby fizycznej
* [revokePermissions](docs/sdks/testdata1/README.md#revokepermissions) - Odebranie uprawnień testowemu podmiotowi/osobie fizycznej
* [revokeAttachment](docs/sdks/testdata1/README.md#revokeattachment) - Odebranie możliwości wysyłania faktur z załącznikiem

### [tokens](docs/sdks/tokens/README.md)

* [generate](docs/sdks/tokens/README.md#generate) - Wygenerowanie nowego tokena
* [list](docs/sdks/tokens/README.md#list) - Pobranie listy wygenerowanych tokenów
* [getStatus](docs/sdks/tokens/README.md#getstatus) - Pobranie statusu tokena
* [delete](docs/sdks/tokens/README.md#delete) - Unieważnienie tokena

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

When custom error responses are specified for an operation, the SDK may also throw their associated exception. You can refer to respective *Errors* tables in SDK docs for more details on possible exception types for each operation. For example, the `getSessions` method throws the following exceptions:

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
    $response = $sdk->auth->getSessions(
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
