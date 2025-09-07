<?php
declare(strict_types=1);

namespace Intermedia\Ksef\Apiv2\Models\Components;

/** SubjectIdentifierTypeEnum */
enum SubjectIdentifierTypeEnum: string
{
    case CERTIFICATE_SUBJECT = 'certificateSubject';
    case CERTIFICATE_FINGERPRINT = 'certificateFingerprint';
}
