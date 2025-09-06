# AuthSessions
(*authSessions*)

## Overview

### Available Operations

* [delete](#delete) - Unieważnienie sesji uwierzytelnienia

## delete

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



$response = $sdk->authSessions->delete(
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