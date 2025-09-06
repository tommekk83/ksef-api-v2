# SessionsBatch
(*sessionsBatch*)

## Overview

### Available Operations

* [open](#open) - Otwarcie sesji wsadowej

## open

Otwiera sesję do wysyłki wsadowej faktur. Należy przekazać schemat wysyłanych faktur, informacje o paczce faktur oraz informacje o kluczu używanym do szyfrowania.

> Więcej informacji:
> - [Przygotwanie paczki faktur](https://github.com/CIRFMF/ksef-docs/blob/main/sesja-wsadowa.md)
> - [Klucz publiczny Ministersta Finansów](/public-keys/publicKey.pem)

Wymagane uprawnienia: `InvoiceWrite`.

### Example Usage

<!-- UsageSnippet language="php" operationID="batch.open" method="post" path="/api/v2/sessions/batch" -->
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

$request = new Operations\BatchOpenRequest(
    formCode: new Operations\BatchOpenFormCode(
        systemCode: 'FA (2)',
        schemaVersion: '1-0E',
        value: 'FA',
    ),
    batchFile: new Operations\BatchFile(
        fileSize: 16037,
        fileHash: 'WO86CC+1Lef11wEosItld/NPwxGN8tobOMLqk9PQjgs=',
        fileParts: [
            new Components\BatchFilePartInfo(
                ordinalNumber: 1,
                fileName: '92cca5be-7f37-4d36-98bb-1f5369841038.zip.aes',
                fileSize: 16048,
                fileHash: '23ZyDAN0H/+yhC/En2xbNfF0tajAWSfejDaXD7fc2AE=',
            ),
        ],
    ),
    encryption: new Operations\BatchOpenEncryption(
        encryptedSymmetricKey: 'bYqmPAglF01AxZim4oNa+1NerhZYfFgLMnvksBprUur1aesQ0Y5jsmOIfCrozfMkF2tjdO+uOsBg4FPlDgjChwN2/tz2Hqwtxq3RkTr1SjY4x8jxJFpPedcS7EI+XO8C+i9mLj7TFx9p/bg07yM9vHtMAk5b88Ay9Qc3+T5Ch1DM2ClR3sVu2DqdlKzmbINY+rhfGtXn58Qo0XRyESGgc6M0iTZVBRPuPXLnD8a1KpOneCpNzLwxgT6Ei3ivLOpPWT53PxkRTaQ8puj6CIiCKo4FHQzHuI/NmrAhYU7TkNm2kymP/OxBgWdg3XB74tqNFfT8RZN1bZXuPhBidDOqa+xsqY3E871FSDmQwZf58HmoNl31XNvpnryiRGfnAISt+m+ELqgksAresVu6E9poUL1yiff+IOHSZABoYpNiqwnbT8qyW1uk8lKLyFVFu+kOsbzBk1OWWHqSkNFDaznDa2MKjHonOXI0uyKaKWvoBFC4dWN1PVumfpSSFAeYgNpAyVrZdcVOuiliEWepTDjGzJoOafTvwr5za2S6B5bPECDpX7JXazV7Olkq7ezG0w8y3olx+0C+NHoCk8B5/cm4gtVHTgKjiLSGpKJVOJABLXFkOyIOjbQsVe4ryX0Qy+SfL7JIQvTWvM5xkCoOMbzLdMo9tNo5qE34sguFI+lIevY=',
        initializationVector: 'jWpJLNBHJ5pQEGCBglmIAw==',
    ),
);

$response = $sdk->sessionsBatch->open(
    request: $request
);

if ($response->openBatchSessionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                  | Type                                                                       | Required                                                                   | Description                                                                |
| -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| `$request`                                                                 | [Operations\BatchOpenRequest](../../Models/Operations/BatchOpenRequest.md) | :heavy_check_mark:                                                         | The request object to use for the request.                                 |

### Response

**[?Operations\BatchOpenResponse](../../Models/Operations/BatchOpenResponse.md)**

### Errors

| Error Type               | Status Code              | Content Type             |
| ------------------------ | ------------------------ | ------------------------ |
| Errors\ExceptionResponse | 400                      | application/json         |
| Errors\APIException      | 4XX, 5XX                 | \*/\*                    |