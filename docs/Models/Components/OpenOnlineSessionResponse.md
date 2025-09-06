# OpenOnlineSessionResponse


## Fields

| Field                                                                          | Type                                                                           | Required                                                                       | Description                                                                    |
| ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ |
| `referenceNumber`                                                              | *string*                                                                       | :heavy_check_mark:                                                             | Numer referencyjny sesji.                                                      |
| `validUntil`                                                                   | [\DateTime](https://www.php.net/manual/en/class.datetime.php)                  | :heavy_check_mark:                                                             | Termin ważności sesji. Po jego upływie sesja zostanie automatycznie zamknięta. |