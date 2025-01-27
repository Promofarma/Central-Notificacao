<?php

declare(strict_types=1);

namespace App\Models;

use App\Filters\Concerns\HasFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationRecipient extends Model
{
    use HasFilter;

    protected function casts(): array
    {
        return [
            'recipient_id' => 'integer',
            'viewed_at' => 'datetime',
            'readed_at' => 'datetime',
            'archived_at' => 'datetime',
        ];
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(Recipient::class);
    }

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class);
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull('readed_at');
    }

    public function scopeRead(Builder $query): Builder
    {
        return $query->whereNotNull('readed_at');
    }

    public function scopeViewed(Builder $query): Builder
    {
        return $query->whereNotNull('viewed_at');
    }

    public function scopeUnviewed(Builder $query): Builder
    {
        return $query->whereNull('viewed_at');
    }

    public function scopeArchived(Builder $query): Builder
    {
        return $query->whereNotNull('archived_at');
    }

    public function scopeUnarchived(Builder $query): Builder
    {
        return $query->whereNull('archived_at');
    }

    public function isRead(): bool
    {
        return $this->readed_at !== null;
    }

    public function isViewed(): bool
    {
        return $this->viewed_at !== null;
    }

    public function isArchived(): bool
    {
        return $this->archived_at !== null;
    }

    public function markAsRead(): void
    {
        $this->update([
            'readed_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
