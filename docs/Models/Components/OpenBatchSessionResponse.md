# OpenBatchSessionResponse


## Fields

| Field                                                                               | Type                                                                                | Required                                                                            | Description                                                                         |
| ----------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------- |
| `referenceNumber`                                                                   | *string*                                                                            | :heavy_check_mark:                                                                  | Numer referencyjny sesji.                                                           |
| `partUploadRequests`                                                                | array<[Components\PartUploadRequest](../../Models/Components/PartUploadRequest.md)> | :heavy_check_mark:                                                                  | Dane wymagane do poprawnego przesłania poszczególnych części pliku paczki faktur.   |