<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\HasToArray;
use App\Enums\Contracts\Arrayable;

enum NotificationRecipientReadStatus: string implements Arrayable
{
    use HasToArray;

    case READ = 'read';

    case UNREAD = 'unread';
}
