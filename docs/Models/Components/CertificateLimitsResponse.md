# CertificateLimitsResponse

Informacje o limitach wniosków oraz certyfikatów dla uwierzytelnionego podmiotu.


## Fields

| Field                                                                                         | Type                                                                                          | Required                                                                                      | Description                                                                                   |
| --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- |
| `canRequest`                                                                                  | *bool*                                                                                        | :heavy_check_mark:                                                                            | Flaga informująca czy uwierzytelniony podmiot może złożyć nowy wniosek o certyfikat.          |
| `enrollment`                                                                                  | [Components\Enrollment](../../Models/Components/Enrollment.md)                                | :heavy_check_mark:                                                                            | Informacje o limitach związanych z liczbą możliwych do złożenia wniosków certyfikacyjnych.    |
| `certificate`                                                                                 | [Components\Certificate](../../Models/Components/Certificate.md)                              | :heavy_check_mark:                                                                            | Informacje o limitach dotyczących liczby aktywnych certyfikatów wydanych dla danego podmiotu. |