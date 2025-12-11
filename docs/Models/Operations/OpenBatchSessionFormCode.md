# OpenBatchSessionFormCode

Schemat faktur wysyłanych w ramach sesji.

Obsługiwane schematy:
| SystemCode | SchemaVersion | Value |
| --- | --- | --- |
| [FA (3)](https://github.com/CIRFMF/ksef-docs/blob/main/faktury/schemy/FA/schemat_FA(3)_v1-0E.xsd) | 1-0E | FA |



## Fields

| Field              | Type               | Required           | Description        |
| ------------------ | ------------------ | ------------------ | ------------------ |
| `systemCode`       | *string*           | :heavy_check_mark: | Kod systemowy      |
| `schemaVersion`    | *string*           | :heavy_check_mark: | Wersja schematu    |
| `value`            | *string*           | :heavy_check_mark: | Wartość            |