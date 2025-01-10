<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\HasToArray;
use App\Enums\Contracts\Arrayable;

enum ScheduleResultStatus: string implements Arrayable
{
    use HasToArray;

    case Pending = 'pending';

    case Created = 'created';

    case Cancelled = 'cancelled';

    public static function icon(ScheduleResultStatus $value): string
    {
        return match ($value) {
            self::Pending => 'circle-dot',
            self::Created => 'check',
            self::Cancelled => 'x',
        };
    }

    public static function color(ScheduleResultStatus $value): string
    {
        return match ($value) {
            self::Pending => 'warning',
            self::Created => 'success',
            self::Cancelled => 'danger',
        };
    }
}
