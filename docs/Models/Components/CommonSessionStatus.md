# CommonSessionStatus

| Wartość | Opis |
| --- | --- |
| InProgress | Sesja aktywna. |
| Succeeded | Sesja przetworzona poprawnie.            W trakcie przetwarzania sesji nie wystąpiły żadne błędy, ale część faktur nadal mogła zostać odrzucona. |
| Failed | Sesja nie przetworzona z powodu błędów.            Na etapie rozpoczynania lub kończenia sesji wystąpiły błędy, które nie pozwoliły na jej poprawne przetworzenie. |
| Cancelled | Sesja anulowania.            Został przekroczony czas na wysyłkę w sesji wsadowej, lub nie przesłano żadnych faktur w sesji interaktywnej. |



## Values

| Name         | Value        |
| ------------ | ------------ |
| `InProgress` | InProgress   |
| `Succeeded`  | Succeeded    |
| `Failed`     | Failed       |
| `Cancelled`  | Cancelled    |