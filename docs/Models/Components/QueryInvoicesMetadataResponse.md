# QueryInvoicesMetadataResponse


## Fields

| Field                                                                           | Type                                                                            | Required                                                                        | Description                                                                     |
| ------------------------------------------------------------------------------- | ------------------------------------------------------------------------------- | ------------------------------------------------------------------------------- | ------------------------------------------------------------------------------- |
| `hasMore`                                                                       | *bool*                                                                          | :heavy_check_mark:                                                              | Flaga informująca o dostępności kolejnej strony wyników.                        |
| `invoices`                                                                      | array<[Components\InvoiceMetadata](../../Models/Components/InvoiceMetadata.md)> | :heavy_check_mark:                                                              | Lista faktur spełniających kryteria.                                            |