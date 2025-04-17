<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ScheduleResultStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

final class NotificationScheduleResult extends Model
{
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'status' => ScheduleResultStatus::class,
            'scheduled_date' => 'date',
            'scheduled_time' => 'date',
            'canceled_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    protected function displayScheduledDate(): Attribute
    {
        return Attribute::get(
            fn(mixed $value = null, array $attributes): ?string => $attributes['scheduled_date']
                ? Carbon::parse($attributes['scheduled_date'])->format('d \\d\\e M Y')
                : null
        );
    }

    protected function displayScheduledTime(): Attribute
    {
        return Attribute::get(
            fn(mixed $value = null, array $attributes): ?string => $attributes['scheduled_time']
                ? 'às ' . Carbon::parse($attributes['scheduled_time'])->format('H:i')
                : null
        );
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(NotificationSchedule::class);
    }

    public function deadline(): int
    {
        $diffInDays = now()->diffInDays($this->scheduled_date);

        return (int) round($diffInDays);
    }
}
