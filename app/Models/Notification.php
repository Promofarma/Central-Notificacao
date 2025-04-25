<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\NotificationSendType;
use App\Filters\Concerns\HasFiltered;
use App\Helpers\FormatsTimestamps;
use App\Observers\NotificationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

#[ObservedBy(NotificationObserver::class)]
final class Notification extends Model
{
    use FormatsTimestamps;
    use HasFiltered;

    public $incrementing = false;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public function getRawContent(): string
    {
        return trim(html_entity_decode(strip_tags($this->content)));
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(NotificationRecipient::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(NotificationAttachment::class);
    }

    public function schedule(): HasOne
    {
        return $this->hasOne(NotificationSchedule::class);
    }

    public function scopeScheduled(Builder $query): Builder
    {
        $now = now();

        return $query
            ->where(function (Builder $query) use ($now): void {
                $query
                    ->whereNotNull('scheduled_date')
                    ->whereDate('scheduled_date', '<=', $now->toDateString())
                    ->where(function (Builder $query) use ($now): void {
                        $query
                            ->whereNull('scheduled_time')
                            ->orWhereTime('scheduled_time', '<=', $now->toTimeString());
                    });
            })
            ->orWhere(function (Builder $query) use ($now): void {
                $query
                    ->whereNull('scheduled_date')
                    ->whereDate('created_at', '<=', $now->toDateString());
            });
    }

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'category_id' => 'integer',
            'user_id' => 'integer',
            'scheduled_date' => 'date',
            'scheduled_time' => 'datetime',
        ];
    }

    protected function sendType(): Attribute
    {
        return Attribute::get(fn (): NotificationSendType => match (true) {
            filled($this->schedule) => NotificationSendType::RECURRING,
            filled($this->scheduled_date) => NotificationSendType::SCHEDULED,
            default => NotificationSendType::SENT,
        });
    }

    protected function scheduledDatetime(): Attribute
    {
        return Attribute::get(fn (): ?Carbon => filled($this->scheduled_date) && filled($this->scheduled_time) ? Carbon::parse($this->scheduled_date->toDateString().' '.$this->scheduled_time->toTimeString()) : null);
    }
}
