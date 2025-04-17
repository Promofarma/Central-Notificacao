<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\NotificationSendType;
use App\Filters\Concerns\HasFilter;
use App\Helpers\FormatsTimestamps;
use App\Observers\NotificationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

#[ObservedBy(NotificationObserver::class)]
final class Notification extends Model
{
    use FormatsTimestamps;
    use HasFilter;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

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

    protected function sendType(): Attribute
    {
        return Attribute::get(fn(): NotificationSendType => match (true) {
            filled($this->schedule) => NotificationSendType::RECURRING,
            filled($this->scheduled_date) => NotificationSendType::SCHEDULED,
            default => NotificationSendType::SENT,
        });
    }

    public function scopeScheduled(Builder $query): Builder
    {
        $today = today();

        return $query->whereDate('scheduled_date', '<=', $today)
            ->orWhere(function (Builder $query) use ($today): Builder {
                return $query->whereNull('scheduled_date')
                    ->whereDate('created_at', '<=', $today);
            });
    }
}
