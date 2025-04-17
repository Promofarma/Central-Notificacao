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

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pendente',
            self::Created => 'Criado',
            self::Cancelled => 'Cancelado',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Pending => 'heroicon-m-clock',
            self::Created => 'heroicon-m-check',
            self::Cancelled => 'heroicon-m-x-mark',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Created => 'success',
            self::Cancelled => 'danger',
        };
    }
}
