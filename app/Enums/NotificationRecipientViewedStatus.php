<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\HasToArray;
use App\Enums\Contracts\Arrayable;

enum NotificationRecipientViewedStatus: string implements Arrayable
{
    use HasToArray;

    case Viewed = 'viewed';

    case Unviewed = 'unviewed';
}
