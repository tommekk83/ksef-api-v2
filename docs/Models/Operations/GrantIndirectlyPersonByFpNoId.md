# GrantIndirectlyPersonByFpNoId

Dane podmiotu.
*Wymagane, gdy subjectDetailsType = PersonByFingerprintWithoutIdentifier.*


## Fields

| Field                                                                                        | Type                                                                                         | Required                                                                                     | Description                                                                                  |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `firstName`                                                                                  | *string*                                                                                     | :heavy_check_mark:                                                                           | Imię osoby fizycznej.                                                                        |
| `lastName`                                                                                   | *string*                                                                                     | :heavy_check_mark:                                                                           | Nazwisko osoby fizycznej.                                                                    |
| `birthDate`                                                                                  | [\DateTime](https://www.php.net/manual/en/class.datetime.php)                                | :heavy_check_mark:                                                                           | Data urodzenia osoby fizycznej.                                                              |
| `idDocument`                                                                                 | [Operations\GrantIndirectlyIdDocument](../../Models/Operations/GrantIndirectlyIdDocument.md) | :heavy_check_mark:                                                                           | Dane dokumentu tożsamości osoby fizycznej.                                                   |