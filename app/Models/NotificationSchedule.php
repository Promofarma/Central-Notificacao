<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NotificationSchedule extends Model
{
    protected function casts(): array
    {
        return [
            'interval_days_of_week' => 'array',
            'interval_day' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(NotificationScheduleResult::class);
    }
}
