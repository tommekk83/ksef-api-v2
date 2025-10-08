# BatchSession

Limity dla sesji wsadowych.


## Fields

| Field                                                             | Type                                                              | Required                                                          | Description                                                       |
| ----------------------------------------------------------------- | ----------------------------------------------------------------- | ----------------------------------------------------------------- | ----------------------------------------------------------------- |
| `maxInvoiceSizeInMib`                                             | *int*                                                             | :heavy_check_mark:                                                | Maksymalny rozmiar faktury w MiB.                                 |
| `maxInvoiceWithAttachmentSizeInMib`                               | *int*                                                             | :heavy_check_mark:                                                | Maksymalny rozmiar faktury z załącznikiem w MiB.                  |
| `maxInvoices`                                                     | *int*                                                             | :heavy_check_mark:                                                | Maksymalna ilość faktur które można przesłać w pojedynczej sesji. |