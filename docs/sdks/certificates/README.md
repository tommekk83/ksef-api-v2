# Certificates
(*certificates*)

## Overview

### Available Operations

* [getLimits](#getlimits) - Pobranie danych o limitach certyfikatów
* [getEnrollmentData](#getenrollmentdata) - Pobranie danych do wniosku certyfikacyjnego
* [processEnrollment](#processenrollment) - Wysyłka wniosku certyfikacyjnego
* [getEnrollmentStatus](#getenrollmentstatus) - Pobranie statusu przetwarzania wniosku certyfikacyjnego
* [retrieve](#retrieve) - Pobranie certyfikatu lub listy certyfikatów
* [revoke](#revoke) - Unieważnienie certyfikatu
* [getList](#getlist) - Pobranie listy metadanych certyfikatów

## getLimits

Zwraca informacje o limitach certyfikatów oraz informacje czy użytkownik może zawnioskować o certyfikat KSeF.

### Example Usage

<!-- UsageSnippet language="php" operationID="getLimits" method="get" path="/api/v2/certificates/limits" -->
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

**[?Operations\GetLimitsResponse](../../Models/Operations/GetLimitsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getEnrollmentData

Zwraca dane wymagane do przygotowania wniosku certyfikacyjnego PKCS#10.

Dane te są zwracane na podstawie certyfikatu użytego w procesie uwierzytelnienia i identyfikują podmiot, który składa wniosek o certyfikat.


> Więcej informacji:
> - [Pobranie danych do wniosku certyfikacyjnego](https://github.com/CIRFMF/ksef-docs/blob/main/certyfikaty-KSeF.md#2-pobranie-danych-do-wniosku-certyfikacyjnego)
> - [Przygotowanie wniosku](https://github.com/CIRFMF/ksef-docs/blob/main/certyfikaty-KSeF.md#3-przygotowanie-csr-certificate-signing-request)

### Example Usage

<!-- UsageSnippet language="php" operationID="getEnrollmentData" method="get" path="/api/v2/certificates/enrollments/data" -->
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

**[?Operations\GetEnrollmentDataResponse](../../Models/Operations/GetEnrollmentDataResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## processEnrollment

Przyjmuje wniosek certyfikacyjny i rozpoczyna jego przetwarzanie.

Dozwolone typy kluczy prywatnych:
- RSA (OID: 1.2.840.113549.1.1.1), długość klucza równa 2048 bitów,
- EC (klucze oparte na krzywych eliptycznych, OID: 1.2.840.10045.2.1), krzywa NIST P-256 (secp256r1)

Zalecane jest stosowanie kluczy EC.

Dozwolone algorytmy podpisu:
- RSA PKCS#1 v1.5,
- RSA PSS,
- ECDSA (format podpisu zgodny z RFC 3279)

Dozwolone funkcje skrótu użyte do podpisu CSR:
- SHA1,
- SHA256,
- SHA384,
- SHA512

> Więcej informacji:
> - [Wysłanie wniosku certyfikacyjnego](https://github.com/CIRFMF/ksef-docs/blob/main/certyfikaty-KSeF.md#4-wys%C5%82anie-wniosku-certyfikacyjnego)

### Example Usage

<!-- UsageSnippet language="php" operationID="processEnrollment" method="post" path="/api/v2/certificates/enrollments" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;
use Intermedia\Ksef\Apiv2\Models\Components;
use Intermedia\Ksef\Apiv2\Models\Operations;
use Intermedia\Ksef\Apiv2\Utils;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$request = new Operations\ProcessEnrollmentRequest(
    certificateName: 'Certyfikat-Auth-004',
    certificateType: Components\KsefCertificateType::Authentication,
    csr: 'MIIDJjCCAd4CAQAwgbAxIjAgBgNVBAMMGUZpcm1hIEtvd2Fsc2tpIENlcnR5ZmlrYXQxIjAgBgNVBAoMGUZpcm1hIEtvd2Fsc2tpIFNwLiB6IG8uby4xEzARBgNVBGEMCjc3NjI4MTE2OTIxCzAJBgNVBAYTAlBMMRUwEwYDVQQFEwxBQkMxMjM0NTY3ODkxLTArBgNVBC0MJGQ5ZDIyNzI0LTQ2OTYtNDYwYy05ZTVlLWI5ZTNhYWZiMGFmMzCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBANZC1hJiB4ZBsxGy/a4yvtOUP0HQxDt7EUZrfKO78+cmI7KCO9aW96yr6O0R928/Y9vmymbgh6KvMUTzZZj24uyxar849O1laor5t8Wv63RDx/I4+9Rt7w+QPPofmpenOokJH+Fm+FDQwo2l07o8SppGfaZpvMak+cDSrh+73wfM37fvPImr9p4ckzzxA9q6f4uoqGqcGSDlSwRjfLQKzWZaEklpZBpY4jeCh54uN3+YLsMQYKdcIbW0Jart1UbwMd/wbHfzFhVmPGOAMMpwVEBw6E4A0CTWIiAX3Alqbx4+IkuqC+gEs3ETTec7eOqhxe9V9cywi7WR+Mz6JO6DJcUCAwEAAaAAMD0GCSqGSIb3DQEBCjAwoA0wCwYJYIZIAWUDBAIBoRowGAYJKoZIhvcNAQEIMAsGCWCGSAFlAwQCAaIDAgEgA4IBAQCJhtF2/2E+JmkWitE/BGbm3NU4fIxr1Z+w0UnHsP+F8n9UDwAnuncG1GH5wZFervldEMooegzEDnYaqxnEUnbZ4wxeAHqpbTZjOOfqrk7o0r66+mXUs5NnyD4M3j3ig98GcvhEdbcNH+RsIwi7FaLNXnOE4SLYL9KvW0geriywWjS+5MmA0Gcn1e4vCD6FeEls8EHzkhrWE+rUsoM5zT2a0OPNXG3fScyOqOZe+OdjT4Y7ScRGy711u3v2X9RoTqQUDfCJ3cob/KRcrzvs1TQVazGZPfcIa6an6SigUvZ7XAMHlUTyOeM4AwKqiEqQ0qfe/HhlDylgZSwulb9u0utT',
    validFrom: Utils\Utils::parseDateTime('2025-08-28T09:22:13.388+00:00'),
);

$response = $sdk->certificates->processEnrollment(
    request: $request
);

if ($response->enrollCertificateResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                  | Type                                                                                       | Required                                                                                   | Description                                                                                |
| ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ |
| `$request`                                                                                 | [Operations\ProcessEnrollmentRequest](../../Models/Operations/ProcessEnrollmentRequest.md) | :heavy_check_mark:                                                                         | The request object to use for the request.                                                 |

### Response

**[?Operations\ProcessEnrollmentResponse](../../Models/Operations/ProcessEnrollmentResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getEnrollmentStatus

Zwraca informacje o statusie wniosku certyfikacyjnego.

### Example Usage

<!-- UsageSnippet language="php" operationID="getEnrollmentStatus" method="get" path="/api/v2/certificates/enrollments/{referenceNumber}" -->
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

**[?Operations\GetEnrollmentStatusResponse](../../Models/Operations/GetEnrollmentStatusResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## retrieve

Zwraca certyfikaty o podanych numerach seryjnych w formacie DER zakodowanym w Base64.

### Example Usage

<!-- UsageSnippet language="php" operationID="retrieveCertificates" method="post" path="/api/v2/certificates/retrieve" -->
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

$request = new Operations\RetrieveCertificatesRequest(
    certificateSerialNumbers: [
        '0321C82DA41B4362',
        '0321F21DA462A362',
    ],
);

$response = $sdk->certificates->retrieve(
    request: $request
);

if ($response->retrieveCertificatesResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                        | Type                                                                                             | Required                                                                                         | Description                                                                                      |
| ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------ |
| `$request`                                                                                       | [Operations\RetrieveCertificatesRequest](../../Models/Operations/RetrieveCertificatesRequest.md) | :heavy_check_mark:                                                                               | The request object to use for the request.                                                       |

### Response

**[?Operations\RetrieveCertificatesResponse](../../Models/Operations/RetrieveCertificatesResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revoke

Unieważnia certyfikat o podanym numerze seryjnym.

### Example Usage

<!-- UsageSnippet language="php" operationID="revokeCertificates" method="post" path="/api/v2/certificates/{certificateSerialNumber}/revoke" -->
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

**[?Operations\RevokeCertificatesResponse](../../Models/Operations/RevokeCertificatesResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getList

Zwraca listę certyfikatów spełniających podane kryteria wyszukiwania.
W przypadku braku podania kryteriów wyszukiwania zwrócona zostanie nieprzefiltrowana lista.

### Example Usage

<!-- UsageSnippet language="php" operationID="getCertificatesList" method="post" path="/api/v2/certificates/query" -->
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

$queryCertificatesRequest = new Components\QueryCertificatesRequest(
    type: Components\Type::Offline,
    status: Components\Status::Active,
);

$response = $sdk->certificates->getList(
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

**[?Operations\GetCertificatesListResponse](../../Models/Operations/GetCertificatesListResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |