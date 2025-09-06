# AuthorIdentifier

Identyfikator osoby lub podmiotu nadającego uprawnienie.
| Type | Value |
| --- | --- |
| Nip | 10 cyfrowy numer NIP |
| Pesel | 11 cyfrowy numer PESEL |
| Fingerprint | Odcisk palca certyfikatu |
| System | Identyfikator systemowy |


## Fields

| Field                                                                                                                | Type                                                                                                                 | Required                                                                                                             | Description                                                                                                          |
| -------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------- |
| `type`                                                                                                               | [Components\PersonPermissionsAuthorIdentifierType](../../Models/Components/PersonPermissionsAuthorIdentifierType.md) | :heavy_check_mark:                                                                                                   | Typ identyfikatora.                                                                                                  |
| `value`                                                                                                              | *string*                                                                                                             | :heavy_check_mark:                                                                                                   | Wartość identyfikatora.                                                                                              |