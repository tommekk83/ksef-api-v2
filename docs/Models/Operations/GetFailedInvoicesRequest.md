# GetFailedInvoicesRequest


## Fields

| Field                                              | Type                                               | Required                                           | Description                                        |
| -------------------------------------------------- | -------------------------------------------------- | -------------------------------------------------- | -------------------------------------------------- |
| `xContinuationToken`                               | *?string*                                          | :heavy_minus_sign:                                 | Token służący do pobrania kolejnej strony wyników. |
| `referenceNumber`                                  | *string*                                           | :heavy_check_mark:                                 | Numer referencyjny sesji.                          |
| `pageSize`                                         | *?int*                                             | :heavy_minus_sign:                                 | Rozmiar strony wyników.                            |