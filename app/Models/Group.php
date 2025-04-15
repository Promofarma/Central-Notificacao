<?php

namespace App\Models;

use App\Enums\GroupStatus;
use App\Observers\GroupObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

#[ObservedBy(GroupObserver::class)]
final class Group extends Model
{
    protected function casts(): array
    {
        return [
            'status' => GroupStatus::class
        ];
    }

    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(Recipient::class, table: 'group_recipients');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getUserIdsFromGroups(array $ids): Collection
    {
        return static::with('recipients:id')
            ->whereIn('id', $ids)
            ->get()
            ->flatMap(fn($group) => $group->recipients->pluck('id'))
            ->unique()
            ->values();
    }

    public function scopeOwnedBy(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', GroupStatus::ACTIVE);
    }
}
