# PartUploadRequest


## Fields

| Field                                                             | Type                                                              | Required                                                          | Description                                                       |
| ----------------------------------------------------------------- | ----------------------------------------------------------------- | ----------------------------------------------------------------- | ----------------------------------------------------------------- |
| `ordinalNumber`                                                   | *?int*                                                            | :heavy_minus_sign:                                                | Numer sekwencyjny części pliku paczki.                            |
| `method`                                                          | *?string*                                                         | :heavy_minus_sign:                                                | Metoda HTTP, której należy użyć przy wysyłce części pliku paczki. |
| `url`                                                             | *?string*                                                         | :heavy_minus_sign:                                                | Adres pod który należy wysłać część pliku paczki.                 |
| `headers`                                                         | array<string, *string*>                                           | :heavy_minus_sign:                                                | Nagłówki, których należy użyć przy wysyłce części pliku paczki.   |