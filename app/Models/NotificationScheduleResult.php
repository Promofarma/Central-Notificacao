<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationScheduleResult extends Model
{
    protected function casts(): array
    {
        return [
            'is_created',
            'is_active',
        ];
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(NotificationSchedule::class);
    }
}
