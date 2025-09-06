# BatchOpenFormCode

Schemat faktur wysyłanych w ramach sesji.

Obsługiwane schematy:
| SystemCode | SchemaVersion | Value |
| --- | --- | --- |
| FA (2) | 1-0E | FA |
| FA (3) | 1-0E | FA |



## Fields

| Field              | Type               | Required           | Description        |
| ------------------ | ------------------ | ------------------ | ------------------ |
| `systemCode`       | *string*           | :heavy_check_mark: | Kod systemowy      |
| `schemaVersion`    | *string*           | :heavy_check_mark: | Wersja schematu    |
| `value`            | *string*           | :heavy_check_mark: | Wartość            |