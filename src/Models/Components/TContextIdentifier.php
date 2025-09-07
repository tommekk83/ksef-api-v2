<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2\Models\Components;

/** Kontekst identyfikatora (Nip | InternalId | NipVatUe). Wymagane dokładnie jedno. */
final class TContextIdentifier
{
    private ?TNip $nip;
    private ?TInternalId $internalId;
    private ?TNipVatUe $nipVatUe;

    public function __construct(?TNip $nip = null, ?TInternalId $internalId = null, ?TNipVatUe $nipVatUe = null)
    {
        $this->nip = $nip;
        $this->internalId = $internalId;
        $this->nipVatUe = $nipVatUe;
        $count = 0;
        foreach ([$this->nip, $this->internalId, $this->nipVatUe] as $v) {
            if ($v !== null) {
                $count++;
            }
        }
        if ($count !== 1) {
            throw new \InvalidArgumentException('TContextIdentifier wymaga dokładnie jednego pola (Nip | InternalId | NipVatUe).');
        }
    }

    public static function fromNip(TNip $nip): self
    {
        return new self($nip, null, null);
    }

    public static function fromInternalId(TInternalId $internalId): self
    {
        return new self(null, $internalId, null);
    }

    public static function fromNipVatUe(TNipVatUe $nipVatUe): self
    {
        return new self(null, null, $nipVatUe);
    }

    public function getNip(): ?TNip
    {
        return $this->nip;
    }

    public function getInternalId(): ?TInternalId
    {
        return $this->internalId;
    }

    public function getNipVatUe(): ?TNipVatUe
    {
        return $this->nipVatUe;
    }
}
