# OpenOnlineSessionFormCode

Schemat faktur wysyłanych w ramach sesji.

Obsługiwane schematy:
| SystemCode | SchemaVersion | Value |
| --- | --- | --- |
| [FA (3)](https://github.com/CIRFMF/ksef-docs/blob/main/faktury/schemy/FA/schemat_FA(3)_v1-0E.xsd) | 1-0E | FA |
| [PEF (3)](https://github.com/CIRFMF/ksef-docs/blob/main/faktury/schemy/PEF/Schemat_PEF(3)_v2-1.xsd) | 2-1 | PEF |
| [PEF_KOR (3)](https://github.com/CIRFMF/ksef-docs/blob/main/faktury/schemy/PEF/Schemat_PEF_KOR(3)_v2-1.xsd) | 2-1 | PEF |



## Fields

| Field              | Type               | Required           | Description        |
| ------------------ | ------------------ | ------------------ | ------------------ |
| `systemCode`       | *string*           | :heavy_check_mark: | Kod systemowy      |
| `schemaVersion`    | *string*           | :heavy_check_mark: | Wersja schematu    |
| `value`            | *string*           | :heavy_check_mark: | Wartość            |