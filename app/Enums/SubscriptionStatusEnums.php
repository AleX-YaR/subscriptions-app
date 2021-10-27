<?php

namespace App\Enums;

final class SubscriptionStatusEnums extends Enum
{
    const NEW = 'new';
    const RENEWED = 'renewed';
    const FAILED_TO_RENEW = 'failed_to_renewed';
    const CANCELLED = 'cancelled';
}
