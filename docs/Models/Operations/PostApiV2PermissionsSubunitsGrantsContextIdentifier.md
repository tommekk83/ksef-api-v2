# PostApiV2PermissionsSubunitsGrantsContextIdentifier

Identyfikator podmiotu podrzędnego.
| Type | Value |
| --- | --- |
| Nip | 10 cyfrowy numer NIP |
| InternalId | Dwuczłonowy identyfikator składający się z numeru NIP i 5 cyfr: `{nip}-{5_cyfr}` |


## Fields

| Field                                                                                                                    | Type                                                                                                                     | Required                                                                                                                 | Description                                                                                                              |
| ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ |
| `type`                                                                                                                   | [Components\SubunitPermissionsContextIdentifierType](../../Models/Components/SubunitPermissionsContextIdentifierType.md) | :heavy_check_mark:                                                                                                       | Typ identyfikatora.                                                                                                      |
| `value`                                                                                                                  | *string*                                                                                                                 | :heavy_check_mark:                                                                                                       | Wartość identyfikatora.                                                                                                  |