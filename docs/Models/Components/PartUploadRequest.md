# PartUploadRequest


## Fields

| Field                                                             | Type                                                              | Required                                                          | Description                                                       |
| ----------------------------------------------------------------- | ----------------------------------------------------------------- | ----------------------------------------------------------------- | ----------------------------------------------------------------- |
| `ordinalNumber`                                                   | *int*                                                             | :heavy_check_mark:                                                | Numer sekwencyjny części pliku paczki.                            |
| `method`                                                          | *string*                                                          | :heavy_check_mark:                                                | Metoda HTTP, której należy użyć przy wysyłce części pliku paczki. |
| `url`                                                             | *string*                                                          | :heavy_check_mark:                                                | Adres pod który należy wysłać część pliku paczki.                 |
| `headers`                                                         | array<string, *string*>                                           | :heavy_check_mark:                                                | Nagłówki, których należy użyć przy wysyłce części pliku paczki.   |