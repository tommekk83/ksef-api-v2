# RefreshToken

Token umożliwiający odświeżenie tokenu dostępu.
> Więcej informacji:
> - [Odświeżanie tokena](https://github.com/CIRFMF/ksef-docs/blob/main/uwierzytelnianie.md#od%C5%9Bwie%C5%BCenie-tokena-accesstoken)


## Fields

| Field                                                         | Type                                                          | Required                                                      | Description                                                   |
| ------------------------------------------------------------- | ------------------------------------------------------------- | ------------------------------------------------------------- | ------------------------------------------------------------- |
| `token`                                                       | *string*                                                      | :heavy_check_mark:                                            | Token w formacie JWT.                                         |
| `validUntil`                                                  | [\DateTime](https://www.php.net/manual/en/class.datetime.php) | :heavy_check_mark:                                            | Data ważności tokena.                                         |