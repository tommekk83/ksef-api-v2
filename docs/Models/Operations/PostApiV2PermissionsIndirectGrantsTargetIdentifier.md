# PostApiV2PermissionsIndirectGrantsTargetIdentifier

Identyfikator podmiotu, w którego kontekście chcemy pośrednio nadać uprawnienia. W przypadku nadawania uprawnienia generalnego, pole to powinno mieć wartość null.
| Type | Value |
| --- | --- |
| Nip | 10 cyfrowy numer NIP |
| AllPartners | Identyfikator oznaczający, że uprawnienie nadane w sposób pośredni jest typu generalnego |


## Fields

| Field                                                                                                                       | Type                                                                                                                        | Required                                                                                                                    | Description                                                                                                                 |
| --------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------- |
| `type`                                                                                                                      | [Components\IndirectPermissionsTargetIdentifierType](../../Models/Components/IndirectPermissionsTargetIdentifierType.md)    | :heavy_check_mark:                                                                                                          | Typ identyfikatora.                                                                                                         |
| `value`                                                                                                                     | *?string*                                                                                                                   | :heavy_minus_sign:                                                                                                          | Wartość identyfikatora. W przypadku typu AllPartners należy pozostawić puste. W pozostałych przypadkach pole jest wymagane. |