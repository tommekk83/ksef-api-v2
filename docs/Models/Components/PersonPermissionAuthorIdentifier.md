# PersonPermissionAuthorIdentifier

Identyfikator osoby lub podmiotu nadającego uprawnienie.
| Type | Value |
| --- | --- |
| Nip | 10 cyfrowy numer NIP |
| Pesel | 11 cyfrowy numer PESEL |
| Fingerprint | Odcisk palca certyfikatu |
| System | Identyfikator systemowy KSeF |


## Fields

| Field                                                                                                                  | Type                                                                                                                   | Required                                                                                                               | Description                                                                                                            |
| ---------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------- |
| `type`                                                                                                                 | [Components\PersonPermissionsAuthorIdentifierType](../../Models/Components/PersonPermissionsAuthorIdentifierType.md)   | :heavy_check_mark:                                                                                                     | Typ identyfikatora.                                                                                                    |
| `value`                                                                                                                | *?string*                                                                                                              | :heavy_minus_sign:                                                                                                     | Wartość identyfikatora. W przypadku typu System należy pozostawić puste. W pozostałych przypadkach pole jest wymagane. |