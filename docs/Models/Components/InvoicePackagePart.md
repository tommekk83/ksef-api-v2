# InvoicePackagePart


## Fields

| Field                                                         | Type                                                          | Required                                                      | Description                                                   |
| ------------------------------------------------------------- | ------------------------------------------------------------- | ------------------------------------------------------------- | ------------------------------------------------------------- |
| `ordinalNumber`                                               | *int*                                                         | :heavy_check_mark:                                            | Numer porządkowy pliku w ramach całego zbioru wynikowego.     |
| `method`                                                      | *string*                                                      | :heavy_check_mark:                                            | Metoda HTTP, której należy użyć przy pobieraniu pliku.        |
| `url`                                                         | *string*                                                      | :heavy_check_mark:                                            | Adres URL, pod który należy wysłać żądanie pobrania pliku.    |
| `expirationDate`                                              | [\DateTime](https://www.php.net/manual/en/class.datetime.php) | :heavy_check_mark:                                            | Data wygaśnięcia linku do pobrania pliku.                     |
| `headers`                                                     | array<string, *string*>                                       | :heavy_check_mark:                                            | Nagłówki, których należy użyć przy pobieraniu pliku.          |
| `fileName`                                                    | *string*                                                      | :heavy_check_mark:                                            | Nazwa pliku.                                                  |