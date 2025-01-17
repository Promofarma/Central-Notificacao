<?php

declare(strict_types=1);

namespace App\Filters;

use App\Filters\Contracts\Filterable;
use Illuminate\Database\Eloquent\Builder;

class NotificationRecipientFilter implements Filterable
{
    public function __construct(
        protected readonly array $data
    ) {
    }

    public function apply(Builder $builder): Builder
    {
        return $builder
            ->when(
                value: $this->getUserId(),
                callback: fn (Builder $query, int $value) => $query->whereHas('notification', fn (Builder $query) => $query->where('user_id', $value)),
            )
            ->when(
                value: $this->getCategoryId(),
                callback: fn (Builder $query, int $value) => $query->whereHas('notification', fn (Builder $query) => $query->where('category_id', $value)),
            )
            ->when(
                value: $this->isRead(),
                callback: fn (Builder $query, bool $value) => $value ? $query->read() : $query->unread(),
            )
            ->when(
                value: $this->isArchived(),
                callback: fn (Builder $query, bool $value) => $value ? $query->archived() : $query->unarchived(),
            );
    }

    public function getUserId(): ?int
    {
        return $this->has('user_id') ? (int) $this->data['user_id'] : null;
    }

    public function getCategoryId(): ?int
    {
        return $this->has('category_id') ? (int) $this->data['category_id'] : null;
    }

    public function isRead(): bool
    {
        return $this->has('is_read') ? (bool) $this->data['is_read'] : false;
    }

    public function isArchived(): bool
    {
        return $this->has('is_archived') ? (bool) $this->data['is_archived'] : false;
    }

    private function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}
