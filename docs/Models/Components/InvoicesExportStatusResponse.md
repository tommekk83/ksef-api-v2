# InvoicesExportStatusResponse


## Fields

| Field                                                          | Type                                                           | Required                                                       | Description                                                    |
| -------------------------------------------------------------- | -------------------------------------------------------------- | -------------------------------------------------------------- | -------------------------------------------------------------- |
| `status`                                                       | [Components\StatusInfo](../../Models/Components/StatusInfo.md) | :heavy_check_mark:                                             | Informacje o aktualnym statusie przetwarzania zapytania.       |
| `completedDate`                                                | [\DateTime](https://www.php.net/manual/en/class.datetime.php)  | :heavy_minus_sign:                                             | Data przetworzenia zapytania                                   |
| `package`                                                      | [?Components\Package](../../Models/Components/Package.md)      | :heavy_minus_sign:                                             | Informacje o paczce faktur.                                    |