# GrantToSubunitsPersonByFpWithId

Dane podmiotu.
*Wymagane, gdy subjectDetailsType = PersonByFingerprintWithIdentifier.*


## Fields

| Field                                                                                        | Type                                                                                         | Required                                                                                     | Description                                                                                  |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `firstName`                                                                                  | *string*                                                                                     | :heavy_check_mark:                                                                           | Imię osoby fizycznej.                                                                        |
| `lastName`                                                                                   | *string*                                                                                     | :heavy_check_mark:                                                                           | Nazwisko osoby fizycznej.                                                                    |
| `identifier`                                                                                 | [Operations\GrantToSubunitsIdentifier](../../Models/Operations/GrantToSubunitsIdentifier.md) | :heavy_check_mark:                                                                           | Identyfikator osoby fizycznej.                                                               |