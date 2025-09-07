<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2\Models\Components;

use InvalidArgumentException;

/** Lista dozwolonych adresów IP / zakresów / masek. */
final class AllowedIps
{
    /** @var string[] */
    private array $ipAddress = [];
    /** @var string[] */
    private array $ipRange = [];
    /** @var string[] */
    private array $ipMask = [];

    public function __construct(array $ipAddress = [], array $ipRange = [], array $ipMask = [])
    {
        foreach ($ipAddress as $v) {
            $this->addIpAddress($v);
        }
        foreach ($ipRange as $v) {
            $this->addIpRange($v);
        }
        foreach ($ipMask as $v) {
            $this->addIpMask($v);
        }
    }

    public function addIpAddress(string $value): void
    {
        if (!preg_match('~^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$~', $value)) {
            throw new InvalidArgumentException('IpAddress nie spełnia wzorca: \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}');
        }
        $this->ipAddress[] = $value;
    }

    public function addIpRange(string $value): void
    {
        if (!preg_match('~^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}-\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$~', $value)) {
            throw new InvalidArgumentException('IpRange nie spełnia wzorca: \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}-\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}');
        }
        $this->ipRange[] = $value;
    }

    public function addIpMask(string $value): void
    {
        if (!preg_match('~^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/(8|16|24|32)$~', $value)) {
            throw new InvalidArgumentException('IpMask nie spełnia wzorca: \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/(8|16|24|32)');
        }
        $this->ipMask[] = $value;
    }

    /** @return string[] */
    public function getIpAddress(): array
    {
        return $this->ipAddress;
    }

    /** @return string[] */
    public function getIpRange(): array
    {
        return $this->ipRange;
    }

    /** @return string[] */
    public function getIpMask(): array
    {
        return $this->ipMask;
    }
}
