<?php

namespace App\Filters;

use App\Enums\NotificationRecipientReadStatus;
use App\Filters\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;

final class NotificationRecipientFilter implements FilterContract
{
    public function __construct(
        protected array $data
    ) {}

    public function apply(Builder $query): Builder
    {
        return $query
            ->when(
                value: $this->data['tab'] ?? null,
                callback: fn(Builder $query, string $value) => match ($value) {
                    'inbox' => $query->unarchived(),
                    'archived' => $query->archived(),
                }
            )
            ->when(
                value: $this->data['recipient_id'] ?? null,
                callback: fn(Builder $query, int $value) => $query->where('recipient_id', $value)
            )
            ->when(
                value: $this->data['user_id'] ?? null,
                callback: fn(Builder $query, int $value) => $query->whereHas('notification', fn(Builder $query): Builder => $query->where('user_id', $value))
            )
            ->when(
                value: $this->data['read_status'] ?? null,
                callback: fn(Builder $query, string $value): Builder => match (NotificationRecipientReadStatus::from($value)) {
                    NotificationRecipientReadStatus::READ => $query->read(),
                    NotificationRecipientReadStatus::UNREAD => $query->unread(),
                    default => $query,
                }
            );
    }
}
