# BatchFile

Informacje o przesyłanej paczce faktur.


## Fields

| Field                                                                                    | Type                                                                                     | Required                                                                                 | Description                                                                              |
| ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- |
| `fileSize`                                                                               | *int*                                                                                    | :heavy_check_mark:                                                                       | Rozmiar pliku paczki w bajtach. Maksymalny rozmiar paczki to 5GB (5_368_709_120 bajtów). |
| `fileHash`                                                                               | *string*                                                                                 | :heavy_check_mark:                                                                       | Skrót SHA256 pliku paczki, zakodowany w formacie Base64.                                 |
| `fileParts`                                                                              | array<[Components\BatchFilePartInfo](../../Models/Components/BatchFilePartInfo.md)>      | :heavy_check_mark:                                                                       | Informacje o częściach pliku paczki. Maksymalna ilość części to 50.                      |