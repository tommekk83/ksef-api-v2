# AuthenticationTokenRefreshResponseAccessToken

Token dostępu, którego należy używać w wywołaniach chronionych zasobów API.


## Fields

| Field                                                         | Type                                                          | Required                                                      | Description                                                   |
| ------------------------------------------------------------- | ------------------------------------------------------------- | ------------------------------------------------------------- | ------------------------------------------------------------- |
| `token`                                                       | *string*                                                      | :heavy_check_mark:                                            | Token w formacie JWT.                                         |
| `validUntil`                                                  | [\DateTime](https://www.php.net/manual/en/class.datetime.php) | :heavy_check_mark:                                            | Data ważności tokena.                                         |