# PostApiV2InvoicesExportsRequest

Dane wejściowe określające kryteria i format eksportu paczki faktur.


## Fields

| Field                                                                                                          | Type                                                                                                           | Required                                                                                                       | Description                                                                                                    |
| -------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------- |
| `encryption`                                                                                                   | [Operations\PostApiV2InvoicesExportsEncryption](../../Models/Operations/PostApiV2InvoicesExportsEncryption.md) | :heavy_check_mark:                                                                                             | Informacje wymagane do zaszyfrowania wyniku zapytania.                                                         |
| `filters`                                                                                                      | [Operations\Filters](../../Models/Operations/Filters.md)                                                       | :heavy_check_mark:                                                                                             | Zestaw filtrów do wyszukiwania faktur.                                                                         |