<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2\Models\Components;

/** TInternalId | Pattern: `[1-9]((\d[1-9])|([1-9]\d))\d{7}-\d{5}` */
final class TInternalId
{
    public function __construct(public readonly string $value)
    {
        $len = mb_strlen($this->value);
        if (!preg_match('~^[1-9]((\d[1-9])|([1-9]\d))\d{7}-\d{5}$~u', $this->value)) {
            throw new \InvalidArgumentException('Value does not match pattern for TInternalId');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
