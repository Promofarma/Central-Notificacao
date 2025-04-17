<?php

declare(strict_types=1);

namespace App\Filters;

use App\Filters\Contracts\Filterable;
use Illuminate\Database\Eloquent\Builder;

final class NotificationFilter implements Filterable
{
    public function __construct(
        protected readonly array $data
    ) {
    }

    public function apply(Builder $builder): Builder
    {
        return $builder
            ->when(
                value: $this->getTitle(),
                callback: fn (Builder $query, string $value) => $query->where('title', 'like', "%{$value}%"),
            )
            ->when(
                value: $this->getUserIds(),
                callback: fn (Builder $query, array $values) => $query->whereIn('user_id', $values),
            )
            ->when(
                value: $this->getRecipientIds(),
                callback: fn (Builder $query, array $values) => $query->whereHas('recipients', fn (Builder $query) => $query->whereIn('recipient_id', $values)),
            )
            ->when(
                value: $this->getCategoryId(),
                callback: fn (Builder $query, int $value) => $query->where('category_id', $value),
            )
            ->when(
                value: $this->getCreatedAtRange(),
                callback: fn (Builder $query, array $values) => $query->whereDate('created_at', '>=', $values['from'])
                    ->whereDate('created_at', '<=', $values['to']),
            );
    }

    private function getTitle(): ?string
    {
        return $this->has('title') ? $this->data['title'] : null;
    }

    private function getUserIds(): array
    {
        return $this->has('user_ids') ? $this->data['user_ids'] : [];
    }

    private function getRecipientIds(): array
    {
        return $this->has('recipient_ids') ? $this->data['recipient_ids'] : [];
    }

    private function getCategoryId(): ?int
    {
        return $this->has('category_id') ? (int) $this->data['category_id'] : null;
    }

    private function getCreatedAtRange(): array
    {
        if (!$this->has('created_at')) {
            return [];
        }

        $createdAt = $this->data['created_at'];

        $hasFromDate = filled($createdAt['from']);

        $hasToDate = filled($createdAt['to']);

        return $hasFromDate && $hasToDate ? $createdAt : [];
    }

    private function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}
