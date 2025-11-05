# BatchSessionRateLimits

Limity dla otwierania/zamykania sesji wsadowych.


## Fields

| Field              | Type               | Required           | Description        |
| ------------------ | ------------------ | ------------------ | ------------------ |
| `perSecond`        | *int*              | :heavy_check_mark: | Limit na sekundę.  |
| `perMinute`        | *int*              | :heavy_check_mark: | Limit na minutę.   |
| `perHour`          | *int*              | :heavy_check_mark: | Limit na godzinę.  |