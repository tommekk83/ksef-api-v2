# Authorizations
(*permissions->authorizations*)

## Overview

### Available Operations

* [revoke](#revoke) - Odebranie uprawnień podmiotowych

## revoke

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



$response = $sdk->permissions->authorizations->revoke(
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