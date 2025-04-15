<?php

namespace App\Enums;

use App\Enums\Concerns\HasToArray;
use App\Enums\Contracts\Arrayable;

enum GroupStatus: string implements Arrayable
{
    use HasToArray;

    case ACTIVE = 'active';

    case INACTIVE = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Ativo',
            self::INACTIVE => 'Inativo'
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger'
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::ACTIVE => 'heroicon-m-check-circle',
            self::INACTIVE => 'heroicon-m-exclamation-triangle'
        };
    }
}
