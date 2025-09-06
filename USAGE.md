<!-- Start SDK Example Usage [usage] -->
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