<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2\Models\Components;

/** Polityka IP klienta dla sesji tokenowej. */
final class IpAddressPolicy
{
    private ?IpChangePolicyEnum $onClientIpChange;
    private ?AllowedIps $allowedIps;

    public function __construct(?IpChangePolicyEnum $onClientIpChange = null, ?AllowedIps $allowedIps = null)
    {
        $this->onClientIpChange = $onClientIpChange;
        $this->allowedIps = $allowedIps;
    }

    public function getOnClientIpChange(): ?IpChangePolicyEnum
    {
        return $this->onClientIpChange;
    }

    public function getAllowedIps(): ?AllowedIps
    {
        return $this->allowedIps;
    }
}
