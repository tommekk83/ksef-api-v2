<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2\Models\Components;

/** TNipVatUe | Pattern: `([1-9]((\d[1-9])|([1-9]\d))\d{7}-((AT)(U\d{8})|(BE)([01]{1}\d{9})|(BG)(\d{9,10})|(CY)(\d{8}[A-Z])|(CZ)(\d{8,10})|(DE)(\d{9})|(DK)(\d{8})|(EE)(\d{9})|(EL)(\d{9})|(ES)([A-Z]\d{8}|\d{8}[A-Z]|[A-Z]\d{7}[A-Z])|(FI)(\d{8})|(FR)[A-Z0-9]{2}\d{9}|(HR)(\d{11})|(HU)(\d{8})|(IE)(\d{7}[A-Z]{2}|\d[A-Z0-9+*]\d{5}[A-Z])|(IT)(\d{11})|(LT)(\d{9}|\d{12})|(LU)(\d{8})|(LV)(\d{11})|(MT)(\d{8})|(NL)([A-Z0-9+*]{12})|(PT)(\d{9})|(RO)(\d{2,10})|(SE)(\d{12})|(SI)(\d{8})|(SK)(\d{10})|(XI)((\d{9}|(\d{12}))|(GD|HA)(\d{3}))))$` */
final class TNipVatUe
{
    public function __construct(public readonly string $value)
    {
        $len = mb_strlen($this->value);
        if (!preg_match('~^([1-9]((\d[1-9])|([1-9]\d))\d{7}-((AT)(U\d{8})|(BE)([01]{1}\d{9})|(BG)(\d{9,10})|(CY)(\d{8}[A-Z])|(CZ)(\d{8,10})|(DE)(\d{9})|(DK)(\d{8})|(EE)(\d{9})|(EL)(\d{9})|(ES)([A-Z]\d{8}|\d{8}[A-Z]|[A-Z]\d{7}[A-Z])|(FI)(\d{8})|(FR)[A-Z0-9]{2}\d{9}|(HR)(\d{11})|(HU)(\d{8})|(IE)(\d{7}[A-Z]{2}|\d[A-Z0-9+*]\d{5}[A-Z])|(IT)(\d{11})|(LT)(\d{9}|\d{12})|(LU)(\d{8})|(LV)(\d{11})|(MT)(\d{8})|(NL)([A-Z0-9+*]{12})|(PT)(\d{9})|(RO)(\d{2,10})|(SE)(\d{12})|(SI)(\d{8})|(SK)(\d{10})|(XI)((\d{9}|(\d{12}))|(GD|HA)(\d{3}))))$~u', $this->value)) {
            throw new \InvalidArgumentException('Value does not match pattern for TNipVatUe');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
