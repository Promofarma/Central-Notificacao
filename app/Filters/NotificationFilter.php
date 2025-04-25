<?php

declare(strict_types=1);

namespace App\Filters;

use App\Filters\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;

final class NotificationFilter implements FilterContract
{
    public function __construct(
        protected array $data
    ) {
    }

    public function apply(Builder $query): Builder
    {
        return $query
            ->when(
                value: $this->data['title'] ?? null,
                callback: fn (Builder $query, string $value) => $query->where('title', 'like', "%{$value}%"),
            )
            ->when(
                value: $this->data['user_ids'] ?? null,
                callback: fn (Builder $query, array $values) => $query->whereIn('user_id', $values),
            )
            ->when(
                value: $this->data['recipient_ids'] ?? null,
                callback: fn (Builder $query, array $values) => $query->whereHas('recipients', fn (Builder $query) => $query->whereIn('recipient_id', $values)),
            )
            ->when(
                value: $this->data['category_id'] ?? null,
                callback: fn (Builder $query, int $value) => $query->where('category_id', $value),
            )
            ->when(
                value: $this->getCreatedAtRange(),
                callback: fn (Builder $query, array $values) => $query->whereDate('created_at', '>=', $values['from'])
                    ->whereDate('created_at', '<=', $values['to']),
            );
    }

    private function getCreatedAtRange(): array
    {
        if (! isset($this->data['created_at'])) {
            return [];
        }

        $createdAt = $this->data['created_at'];

        $hasFromDate = filled($createdAt['from']);

        $hasToDate = filled($createdAt['to']);

        return $hasFromDate && $hasToDate ? $createdAt : [];
    }
}
