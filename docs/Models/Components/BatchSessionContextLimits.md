# BatchSessionContextLimits

Limity dla sesji wsadowych.


## Fields

| Field                                                             | Type                                                              | Required                                                          | Description                                                       |
| ----------------------------------------------------------------- | ----------------------------------------------------------------- | ----------------------------------------------------------------- | ----------------------------------------------------------------- |
| `maxInvoiceSizeInMB`                                              | *int*                                                             | :heavy_check_mark:                                                | Maksymalny rozmiar faktury w MB.                                  |
| `maxInvoiceWithAttachmentSizeInMB`                                | *int*                                                             | :heavy_check_mark:                                                | Maksymalny rozmiar faktury z załącznikiem w MB.                   |
| `maxInvoices`                                                     | *int*                                                             | :heavy_check_mark:                                                | Maksymalna ilość faktur które można przesłać w pojedynczej sesji. |