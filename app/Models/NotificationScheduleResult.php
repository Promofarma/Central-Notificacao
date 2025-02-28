<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ScheduleResultStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class NotificationScheduleResult extends Model
{
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'status' => ScheduleResultStatus::class,
            'scheduled_at' => 'date',
            'canceled_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    protected function displayScheduledAt(): Attribute
    {
        return Attribute::get(
            fn (mixed $value = null, array $attributes): ?string => $attributes['scheduled_at']
                ? Carbon::parse($attributes['scheduled_at'])->format('d \\d\\e M Y')
                : null
        );
    }

    protected function displayShippingAt(): Attribute
    {
        return Attribute::get(
            fn (mixed $value = null, array $attributes): ?string => $attributes['shipping_at']
                ? 'às '.Carbon::parse($attributes['shipping_at'])->format('H:i')
                : null
        );
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(NotificationSchedule::class);
    }

    public function deadline(): int
    {
        $diffInDays = now()->diffInDays($this->scheduled_at);

        return (int) round($diffInDays);
    }
}
