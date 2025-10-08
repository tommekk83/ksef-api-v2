# ExportRequest

Dane wejściowe określające kryteria i format eksportu paczki faktur.


## Fields

| Field                                                                      | Type                                                                       | Required                                                                   | Description                                                                |
| -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| `encryption`                                                               | [Operations\ExportEncryption](../../Models/Operations/ExportEncryption.md) | :heavy_check_mark:                                                         | Informacje wymagane do zaszyfrowania wyniku zapytania.                     |
| `filters`                                                                  | [Operations\Filters](../../Models/Operations/Filters.md)                   | :heavy_check_mark:                                                         | Zestaw filtrów do wyszukiwania faktur.                                     |