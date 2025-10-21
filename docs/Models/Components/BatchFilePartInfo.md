# BatchFilePartInfo


## Fields

| Field                                                                         | Type                                                                          | Required                                                                      | Description                                                                   |
| ----------------------------------------------------------------------------- | ----------------------------------------------------------------------------- | ----------------------------------------------------------------------------- | ----------------------------------------------------------------------------- |
| `ordinalNumber`                                                               | *int*                                                                         | :heavy_check_mark:                                                            | Numer sekwencyjny części pliku paczki.                                        |
| `fileName`                                                                    | *string*                                                                      | :heavy_check_mark:                                                            | Nazwa części pliku paczki.                                                    |
| `fileSize`                                                                    | *int*                                                                         | :heavy_check_mark:                                                            | Rozmiar zaszyfrowanej części pliku paczki w bajtach.                          |
| `fileHash`                                                                    | *string*                                                                      | :heavy_check_mark:                                                            | Skrót SHA256 zaszyfrowanej części pliku paczki, zakodowany w formacie Base64. |