<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2\Models\Components;

/** IpChangePolicyEnum */
enum IpChangePolicyEnum: string
{
    case IGNORE = 'ignore';
    case REJECT = 'reject';
}
