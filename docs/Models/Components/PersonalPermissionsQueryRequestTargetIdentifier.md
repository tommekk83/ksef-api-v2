# PersonalPermissionsQueryRequestTargetIdentifier

Identyfikator podmiotu docelowego (dla uprawnień pośrednich).
| Type | Value |
| --- | --- |
| Nip | 10 cyfrowy numer NIP |
| AllPartners | Identyfikator oznaczający, że uprawnienie nadane w sposób pośredni jest typu generalnego |


## Fields

| Field                                                                                                                       | Type                                                                                                                        | Required                                                                                                                    | Description                                                                                                                 |
| --------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- |
| `type`                                                                                                                      | [Components\PersonalPermissionsTargetIdentifierType](../../Models/Components/PersonalPermissionsTargetIdentifierType.md)    | :heavy_check_mark:                                                                                                          | Typ identyfikatora.                                                                                                         |
| `value`                                                                                                                     | *?string*                                                                                                                   | :heavy_minus_sign:                                                                                                          | Wartość identyfikatora. W przypadku typu AllPartners należy pozostawić puste. W pozostałych przypadkach pole jest wymagane. |