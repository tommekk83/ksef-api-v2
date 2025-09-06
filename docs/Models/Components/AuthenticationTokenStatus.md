# AuthenticationTokenStatus

| Wartość | Opis |
| --- | --- |
| Pending | Token został utworzony ale jest jeszcze w trakcie aktywacji i nadawania uprawnień. Nie może być jeszcze wykorzystywany do uwierzytelniania. |
| Active | Token jest aktywny i może być wykorzystywany do uwierzytelniania. |
| Revoking | Token jest w trakcie unieważniania. Nie może już być wykorzystywany do uwierzytelniania. |
| Revoked | Token został unieważniony i nie może być wykorzystywany do uwierzytelniania. |
| Failed | Nie udało się aktywować tokena. Należy wygenerować nowy token, obecny nie może być wykorzystywany do uwierzytelniania. |



## Values

| Name       | Value      |
| ---------- | ---------- |
| `Pending`  | Pending    |
| `Active`   | Active     |
| `Revoking` | Revoking   |
| `Revoked`  | Revoked    |
| `Failed`   | Failed     |