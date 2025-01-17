<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\HasToArray;
use App\Enums\Contracts\Arrayable;

enum NotificationRecipientArchiveStatus: string implements Arrayable
{
    use HasToArray;

    case Unarchived = 'unarchived';

    case Archived = 'archived';
}
