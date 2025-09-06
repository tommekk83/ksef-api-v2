# Certificates
(*certificates*)

## Overview

### Available Operations

* [getLimits](#getlimits) - Pobranie danych o limitach certyfikatów
* [getEnrollmentData](#getenrollmentdata) - Pobranie danych do wniosku certyfikacyjnego
* [processEnrollment](#processenrollment) - Wysyłka wniosku certyfikacyjnego
* [getEnrollmentStatus](#getenrollmentstatus) - Pobranie statusu przetwarzania wniosku certyfikacyjnego
* [revoke](#revoke) - Unieważnienie certyfikatu
* [query](#query) - Pobranie listy metadanych certyfikatów

## getLimits

Zwraca informacje o limitach certyfikatów oraz informacje czy użytkownik może zawnioskować o certyfikat KSeF.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/certificates/limits" method="get" path="/api/v2/certificates/limits" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->certificates->getLimits(

);

if ($response->certificateLimitsResponse !== null) {
    // handle response
}
```

### Response

**[?Operations\GetApiV2CertificatesLimitsResponse](../../Models/Operations/GetApiV2CertificatesLimitsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getEnrollmentData

Zwraca dane wymagane do przygotowania wniosku certyfikacyjnego PKCS#10.

Dane te są zwracane na podstawie certyfikatu użytego w procesie uwierzytelnienia i identyfikują podmiot, który składa wniosek o certyfikat.


> Więcej informacji:
> - [Pobranie danych do wniosku certyfikacyjnego](https://github.com/CIRFMF/ksef-client-docs/blob/main/certyfikaty-wewn%C4%99trzne-KSeF.md#2-pobranie-danych-do-wniosku-certyfikacyjnego)
> - [Przygotowanie wniosku](https://github.com/CIRFMF/ksef-client-docs/blob/main/certyfikaty-wewn%C4%99trzne-KSeF.md#3-przygotowanie-csr-certificate-signing-request)

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/certificates/enrollments/data" method="get" path="/api/v2/certificates/enrollments/data" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->certificates->getEnrollmentData(

);

if ($response->certificateEnrollmentDataResponse !== null) {
    // handle response
}
```

### Response

**[?Operations\GetApiV2CertificatesEnrollmentsDataResponse](../../Models/Operations/GetApiV2CertificatesEnrollmentsDataResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## processEnrollment

Przyjmuje wniosek certyfikacyjny i rozpoczyna jego przetwarzanie.

Dozwolone typy kluczy prywatnych używanych do podpisu wniosku (CSR):
- RSA (OID: 1.2.840.113549.1.1.1), długość klucza co najmniej 2048 bitów,
- EC (klucze oparte na krzywych eliptycznych, OID: 1.2.840.10045.2.1), długość klucza co najmniej 256 bitów.

Rekomendowane jest wykorzystywanie kluczy EC.

> Więcej informacji:
> - [Wysłanie wniosku certyfikacyjnego](https://github.com/CIRFMF/ksef-client-docs/blob/main/certyfikaty-wewn%C4%99trzne-KSeF.md#4-wys%C5%82anie-wniosku-certyfikacyjnego)

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/certificates/enrollments" method="post" path="/api/v2/certificates/enrollments" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->certificates->processEnrollment(
    request: $request
);

if ($response->enrollCertificateResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                | Type                                                                                                                     | Required                                                                                                                 | Description                                                                                                              |
| ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ |
| `$request`                                                                                                               | [Operations\PostApiV2CertificatesEnrollmentsRequest](../../Models/Operations/PostApiV2CertificatesEnrollmentsRequest.md) | :heavy_check_mark:                                                                                                       | The request object to use for the request.                                                                               |

### Response

**[?Operations\PostApiV2CertificatesEnrollmentsResponse](../../Models/Operations/PostApiV2CertificatesEnrollmentsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getEnrollmentStatus

Zwraca informacje o statusie wniosku certyfikacyjnego.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/certificates/enrollments/{referenceNumber}" method="get" path="/api/v2/certificates/enrollments/{referenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->certificates->getEnrollmentStatus(
    referenceNumber: '<value>'
);

if ($response->certificateEnrollmentStatusResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                   | Type                                        | Required                                    | Description                                 |
| ------------------------------------------- | ------------------------------------------- | ------------------------------------------- | ------------------------------------------- |
| `referenceNumber`                           | *string*                                    | :heavy_check_mark:                          | Numer referencyjny wniosku certyfikacyjnego |

### Response

**[?Operations\GetApiV2CertificatesEnrollmentsReferenceNumberResponse](../../Models/Operations/GetApiV2CertificatesEnrollmentsReferenceNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revoke

Unieważnia certyfikat o podanym numerze seryjnym.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/certificates/{certificateSerialNumber}/revoke" method="post" path="/api/v2/certificates/{certificateSerialNumber}/revoke" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->certificates->revoke(
    certificateSerialNumber: '<value>',
    revokeCertificateRequest: $revokeCertificateRequest

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                   | Type                                                                                        | Required                                                                                    | Description                                                                                 |
| ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- |
| `certificateSerialNumber`                                                                   | *string*                                                                                    | :heavy_check_mark:                                                                          | Numer seryjny certyfikatu (w formacie szesnastkowym).                                       |
| `revokeCertificateRequest`                                                                  | [?Components\RevokeCertificateRequest](../../Models/Components/RevokeCertificateRequest.md) | :heavy_minus_sign:                                                                          | N/A                                                                                         |

### Response

**[?Operations\PostApiV2CertificatesCertificateSerialNumberRevokeResponse](../../Models/Operations/PostApiV2CertificatesCertificateSerialNumberRevokeResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## query

Zwraca listę certyfikatów spełniających podane kryteria wyszukiwania.
W przypadku braku podania kryteriów wyszukiwania zwrócona zostanie nieprzefiltrowana lista.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/certificates/query" method="post" path="/api/v2/certificates/query" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->certificates->query(
    pageSize: 10,
    pageOffset: 0,
    queryCertificatesRequest: $queryCertificatesRequest

);

if ($response->queryCertificatesResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                   | Type                                                                                        | Required                                                                                    | Description                                                                                 |
| ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- |
| `pageSize`                                                                                  | *?int*                                                                                      | :heavy_minus_sign:                                                                          | Rozmiar strony wyników                                                                      |
| `pageOffset`                                                                                | *?int*                                                                                      | :heavy_minus_sign:                                                                          | Numer strony wyników                                                                        |
| `queryCertificatesRequest`                                                                  | [?Components\QueryCertificatesRequest](../../Models/Components/QueryCertificatesRequest.md) | :heavy_minus_sign:                                                                          | Kryteria filtrowania                                                                        |

### Response

**[?Operations\PostApiV2CertificatesQueryResponse](../../Models/Operations/PostApiV2CertificatesQueryResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |