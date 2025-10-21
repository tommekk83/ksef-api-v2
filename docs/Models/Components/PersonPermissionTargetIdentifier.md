# PersonPermissionTargetIdentifier

Identyfikator podmiotu docelowego dla uprawnień nadanych pośrednio.
| Type | Value |
| --- | --- |
| Nip | 10 cyfrowy numer NIP |
| AllPartners | Identyfikator oznaczający, że uprawnienie nadane w sposób pośredni jest typu generalnego |
| InternalId | Dwuczłonowy identyfikator składający się z numeru NIP i 5 cyfr: `{nip}-{5_cyfr}` |


## Fields

| Field                                                                                                                       | Type                                                                                                                        | Required                                                                                                                    | Description                                                                                                                 |
| --------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- |
| `type`                                                                                                                      | [Components\PersonPermissionsTargetIdentifierType](../../Models/Components/PersonPermissionsTargetIdentifierType.md)        | :heavy_check_mark:                                                                                                          | Typ identyfikatora.                                                                                                         |
| `value`                                                                                                                     | *?string*                                                                                                                   | :heavy_minus_sign:                                                                                                          | Wartość identyfikatora. W przypadku typu AllPartners należy pozostawić puste. W pozostałych przypadkach pole jest wymagane. |