# PostApiV2PermissionsSubunitsGrantsSubjectIdentifier

Identyfikator podmiotu lub osoby fizycznej.
| Type | Value |
| --- | --- |
| Nip | 10 cyfrowy numer NIP |
| Pesel | 11 cyfrowy numer PESEL |
| Fingerprint | Odcisk palca certyfikatu |


## Fields

| Field                                                                                                                    | Type                                                                                                                     | Required                                                                                                                 | Description                                                                                                              |
| ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ |
| `type`                                                                                                                   | [Components\SubunitPermissionsSubjectIdentifierType](../../Models/Components/SubunitPermissionsSubjectIdentifierType.md) | :heavy_check_mark:                                                                                                       | Typ identyfikatora.                                                                                                      |
| `value`                                                                                                                  | *string*                                                                                                                 | :heavy_check_mark:                                                                                                       | Wartość identyfikatora.                                                                                                  |