# SubunitPermissionsQueryRequestSubunitIdentifier

Identyfikator jednostki lub podmiotu podrzędnego.
| Type | Value |
| --- | --- |
| InternalId | Dwuczłonowy identyfikator składający się z numeru NIP i 5 cyfr: `{nip}-{5_cyfr}` |
| Nip | 10 cyfrowy numer NIP |


## Fields

| Field                                                                                                                    | Type                                                                                                                     | Required                                                                                                                 | Description                                                                                                              |
| ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------ |
| `type`                                                                                                                   | [Components\SubunitPermissionsSubunitIdentifierType](../../Models/Components/SubunitPermissionsSubunitIdentifierType.md) | :heavy_check_mark:                                                                                                       | Typ identyfikatora.                                                                                                      |
| `value`                                                                                                                  | *string*                                                                                                                 | :heavy_check_mark:                                                                                                       | Wartość identyfikatora.                                                                                                  |