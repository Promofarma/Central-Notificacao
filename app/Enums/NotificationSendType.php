<?php

namespace App\Enums;

enum NotificationSendType: string
{
    case SENT = 'sent';

    case SCHEDULED = 'scheduled';

    case RECURRING = 'recurring';

    public function label(): string
    {
        return match ($this) {
            self::SENT => 'Notificação enviada',
            self::SCHEDULED => 'Notificação programada',
            self::RECURRING => 'Notificação recorrente',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::SENT => 'heroicon-s-paper-airplane',
            self::SCHEDULED => 'heroicon-s-clock',
            self::RECURRING => 'heroicon-s-arrow-path',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SENT => 'success',
            self::SCHEDULED => 'warning',
            self::RECURRING => 'info',
        };
    }
}
