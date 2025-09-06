# CertificateEnrollmentDataResponse


## Fields

| Field                      | Type                       | Required                   | Description                |
| -------------------------- | -------------------------- | -------------------------- | -------------------------- |
| `commonName`               | *string*                   | :heavy_check_mark:         | Nazwa powszechna.          |
| `countryName`              | *string*                   | :heavy_check_mark:         | Kraj, kod ISO 3166.        |
| `givenNames`               | array<*string*>            | :heavy_minus_sign:         | Imiona.                    |
| `surname`                  | *?string*                  | :heavy_minus_sign:         | Nazwisko.                  |
| `serialNumber`             | *?string*                  | :heavy_minus_sign:         | Numer seryjny podmiotu.    |
| `uniqueIdentifier`         | *?string*                  | :heavy_minus_sign:         | Unikalny identyfikator.    |
| `organizationName`         | *?string*                  | :heavy_minus_sign:         | Nazwa organizacji.         |
| `organizationIdentifier`   | *?string*                  | :heavy_minus_sign:         | Identyfikator organizacji. |