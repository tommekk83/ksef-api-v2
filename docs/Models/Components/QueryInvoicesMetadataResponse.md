# QueryInvoicesMetadataResponse


## Fields

| Field                                                                              | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `hasMore`                                                                          | *bool*                                                                             | :heavy_check_mark:                                                                 | Określa, czy istnieją kolejne wyniki zapytania.                                    |
| `isTruncated`                                                                      | *bool*                                                                             | :heavy_check_mark:                                                                 | Określa, czy osiągnięto maksymalny dopuszczalny zakres wyników zapytania (10 000). |
| `invoices`                                                                         | array<[Components\InvoiceMetadata](../../Models/Components/InvoiceMetadata.md)>    | :heavy_check_mark:                                                                 | Lista faktur spełniających kryteria.                                               |