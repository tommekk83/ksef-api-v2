# Auth
(*auth*)

## Overview

### Available Operations

* [getCurrentSessions](#getcurrentsessions) - Pobranie listy aktywnych sesji
* [revokeCurrentSession](#revokecurrentsession) - Unieważnienie aktualnej sesji uwierzytelnienia
* [revokeSession](#revokesession) - Unieważnienie sesji uwierzytelnienia
* [challenge](#challenge) - Inicjalizacja uwierzytelnienia
* [withXades](#withxades) - Uwierzytelnienie z wykorzystaniem podpisu XAdES
* [withKsefToken](#withkseftoken) - Uwierzytelnienie z wykorzystaniem tokena KSeF
* [getStatus](#getstatus) - Pobranie statusu uwierzytelniania
* [redeemToken](#redeemtoken) - Pobranie tokenów dostępowych
* [refreshToken](#refreshtoken) - Odświeżenie tokena dostępowego

## getCurrentSessions

Zwraca listę aktywnych sesji uwierzytelnienia.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/auth/sessions" method="get" path="/api/v2/auth/sessions" -->
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

### Parameters

| Parameter                                          | Type                                               | Required                                           | Description                                        |
| -------------------------------------------------- | -------------------------------------------------- | -------------------------------------------------- | -------------------------------------------------- |
| `xContinuationToken`                               | *?string*                                          | :heavy_minus_sign:                                 | Token służący do pobrania kolejnej strony wyników. |
| `pageSize`                                         | *?int*                                             | :heavy_minus_sign:                                 | Rozmiar strony wyników.                            |

### Response

**[?Operations\GetApiV2AuthSessionsResponse](../../Models/Operations/GetApiV2AuthSessionsResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revokeCurrentSession

Unieważnia sesję powiązaną z tokenem użytym do wywołania tej operacji.

Unieważnienie sesji sprawia, że powiązany z nią refresh token przestaje działać i nie można już za jego pomocą uzyskać kolejnych access tokenów.
**Aktywne access tokeny działają do czasu minięcia ich termin ważności.**

Sposób uwierzytelnienia: `RefreshToken` lub `AccessToken`.

### Example Usage

<!-- UsageSnippet language="php" operationID="delete_/api/v2/auth/sessions/current" method="delete" path="/api/v2/auth/sessions/current" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->revokeCurrentSession(

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Response

**[?Operations\DeleteApiV2AuthSessionsCurrentResponse](../../Models/Operations/DeleteApiV2AuthSessionsCurrentResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## revokeSession

Unieważnia sesję o podanym numerze referencyjnym.

Unieważnienie sesji sprawia, że powiązany z nią refresh token przestaje działać i nie można już za jego pomocą uzyskać kolejnych access tokenów.
**Aktywne access tokeny działają do czasu minięcia ich termin ważności.**

### Example Usage

<!-- UsageSnippet language="php" operationID="delete_/api/v2/auth/sessions/{referenceNumber}" method="delete" path="/api/v2/auth/sessions/{referenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->revokeSession(
    referenceNumber: '<value>'
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                  | Type                                       | Required                                   | Description                                |
| ------------------------------------------ | ------------------------------------------ | ------------------------------------------ | ------------------------------------------ |
| `referenceNumber`                          | *string*                                   | :heavy_check_mark:                         | Numer referencyjny sesji uwierzytelnienia. |

### Response

**[?Operations\DeleteApiV2AuthSessionsReferenceNumberResponse](../../Models/Operations/DeleteApiV2AuthSessionsReferenceNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## challenge

Generuje unikalny challenge wymagany w kolejnym kroku operacji uwierzytelnienia.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/auth/challenge" method="post" path="/api/v2/auth/challenge" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->challenge(

);

if ($response->authenticationChallengeResponse !== null) {
    // handle response
}
```

### Response

**[?Operations\PostApiV2AuthChallengeResponse](../../Models/Operations/PostApiV2AuthChallengeResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## withXades

Rozpoczyna operację uwierzytelniania za pomocą dokumentu XML podpisanego podpisem elektronicznym XAdES.

> Więcej informacji:
> - [Przygotowanie dokumentu XML](https://github.com/CIRFMF/ksef-docs/blob/main/uwierzytelnianie.md#1-przygotowanie-dokumentu-xml-authtokenrequest)
> - [Podpis dokumentu XML](https://github.com/CIRFMF/ksef-docs/blob/main/uwierzytelnianie.md#2-podpisanie-dokumentu-xades)
> - [Schemat XSD](/docs/v2/schemas/authv2.xsd)

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/auth/xades-signature" method="post" path="/api/v2/auth/xades-signature" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->withXades(
    requestBody: '<?xml version="1.0" encoding="utf-8"?>\n' .
    '<AuthTokenRequest xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://ksef.mf.gov.pl/auth/token/2.0">\n' .
    '\n' .
    '    <Challenge>20250625-CR-20F5EE4000-DA48AE4124-46</Challenge>\n' .
    '    <ContextIdentifier>\n' .
    '        <Nip>5265877635</Nip>\n' .
    '    </ContextIdentifier>\n' .
    '    <SubjectIdentifierType>certificateSubject</SubjectIdentifierType>\n' .
    '    <ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="Signature-9707709">\n' .
    '        <!-- Tu powinien być podpis XAdES -->\n' .
    '    </ds:Signature>\n' .
    '</AuthTokenRequest>'
);

if ($response->authenticationInitResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                          | Type                                                                                                                                                                                               | Required                                                                                                                                                                                           | Description                                                                                                                                                                                        |
| -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `requestBody`                                                                                                                                                                                      | *string*                                                                                                                                                                                           | :heavy_check_mark:                                                                                                                                                                                 | N/A                                                                                                                                                                                                |
| `verifyCertificateChain`                                                                                                                                                                           | *?bool*                                                                                                                                                                                            | :heavy_minus_sign:                                                                                                                                                                                 | Wymuszenie weryfikacji zaufania łańcucha certyfikatu wraz ze sprawdzeniem statusu certyfikatu (OCSP/CRL) na środowiskach które umożliwiają wykorzystanie samodzielnie wygenerowanych certyfikatów. |

### Response

**[?Operations\PostApiV2AuthXadesSignatureResponse](../../Models/Operations/PostApiV2AuthXadesSignatureResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## withKsefToken

Rozpoczyna operację uwierzytelniania z wykorzystaniem wcześniej wygenerowanego tokena KSeF.

Token KSeF wraz z timestampem ze wcześniej wygenerowanego challenge'a (w formacie ```token|timestamp```) powinien zostać zaszyfrowany dedykowanym do tego celu kluczem publicznym.
- Timestamp powinien zostać przekazany jako **liczba milisekund od 1 stycznia 1970 roku (Unix timestamp)**.
- Algorytm szyfrowania: **RSA-OAEP (z użyciem SHA-256 jako funkcji skrótu)**.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/auth/ksef-token" method="post" path="/api/v2/auth/ksef-token" -->
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

$request = new Operations\PostApiV2AuthKsefTokenRequest(
    challenge: '20250625-CR-2FDC223000-C2BFC98A9C-4E',
    contextIdentifier: new Operations\PostApiV2AuthKsefTokenContextIdentifier(
        type: Components\ContextIdentifierType::Nip,
        value: '5265877635',
    ),
    encryptedToken: '<value>',
);

$response = $sdk->auth->withKsefToken(
    request: $request
);

if ($response->authenticationInitResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                            | Type                                                                                                 | Required                                                                                             | Description                                                                                          |
| ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- |
| `$request`                                                                                           | [Operations\PostApiV2AuthKsefTokenRequest](../../Models/Operations/PostApiV2AuthKsefTokenRequest.md) | :heavy_check_mark:                                                                                   | The request object to use for the request.                                                           |

### Response

**[?Operations\PostApiV2AuthKsefTokenResponse](../../Models/Operations/PostApiV2AuthKsefTokenResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## getStatus

Sprawdza bieżący status operacji uwierzytelniania dla podanego tokena.

Sposób uwierzytelnienia: `AuthenticationToken` otrzymany przy rozpoczęciu operacji uwierzytelniania.

### Example Usage

<!-- UsageSnippet language="php" operationID="get_/api/v2/auth/{referenceNumber}" method="get" path="/api/v2/auth/{referenceNumber}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->getStatus(
    referenceNumber: '<value>'
);

if ($response->authenticationOperationStatusResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                           | Type                                                                                | Required                                                                            | Description                                                                         |
| ----------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------- |
| `referenceNumber`                                                                   | *string*                                                                            | :heavy_check_mark:                                                                  | Numer referencyjny tokena otrzymanego przy inicjalizacji operacji uwierzytelniania. |

### Response

**[?Operations\GetApiV2AuthReferenceNumberResponse](../../Models/Operations/GetApiV2AuthReferenceNumberResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## redeemToken

Pobiera parę tokenów (access token i refresh token) wygenerowanych w ramach pozytywnie zakończonego procesu uwierzytelniania.
**Tokeny można pobrać tylko raz.**

Sposób uwierzytelnienia: `AuthenticationToken` otrzymany przy rozpoczęciu operacji uwierzytelniania.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/auth/token/redeem" method="post" path="/api/v2/auth/token/redeem" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->redeemToken(

);

if ($response->authenticationTokensResponse !== null) {
    // handle response
}
```

### Response

**[?Operations\PostApiV2AuthTokenRedeemResponse](../../Models/Operations/PostApiV2AuthTokenRedeemResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |

## refreshToken

Generuje nowy token dostępu na podstawie ważnego refresh tokena.

Sposób uwierzytelnienia: `RefreshToken`.

### Example Usage

<!-- UsageSnippet language="php" operationID="post_/api/v2/auth/token/refresh" method="post" path="/api/v2/auth/token/refresh" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Intermedia\Ksef\Apiv2;

$sdk = Apiv2\Client::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->auth->refreshToken(

);

if ($response->authenticationTokenRefreshResponse !== null) {
    // handle response
}
```

### Response

**[?Operations\PostApiV2AuthTokenRefreshResponse](../../Models/Operations/PostApiV2AuthTokenRefreshResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |