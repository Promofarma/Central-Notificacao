<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\HasToArray;

enum NotificationType: string
{
    use HasToArray;

    case Toast = 'toast';

    case Banner = 'banner';

    public function isToast(): bool
    {
        return $this === NotificationType::Toast;
    }

    public function isBanner(): bool
    {
        return $this === NotificationType::Banner;
    }
}
