<?php

declare(strict_types=1);

namespace App\Models;

use App\Filters\Concerns\HasFilter;
use App\Helpers\FormatsTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Notification extends Model
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
            'scheduled_at' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Model $model): void {
            $model->uuid = Str::orderedUuid()->toString();
        });
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
}
