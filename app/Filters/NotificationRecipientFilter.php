<?php

declare(strict_types=1);

namespace App\Filters;

use App\Enums\NotificationRecipientArchiveStatus;
use App\Enums\NotificationRecipientReadStatus;
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
                callback: fn (Builder $query, int $value): Builder => $query->whereHas('notification', fn (Builder $query): Builder => $query->where('user_id', $value)),
            )
            ->when(
                value: $this->getCategoryId(),
                callback: fn (Builder $query, int $value): Builder => $query->whereHas('notification', fn (Builder $query): Builder => $query->where('category_id', $value)),
            )
            ->when(
                value: $this->getReadStatus(),
                callback: fn (Builder $query, NotificationRecipientReadStatus $value): Builder => match ($value) {
                    NotificationRecipientReadStatus::Read => $query->read(),
                    NotificationRecipientReadStatus::Unread => $query->unread(),
                },
            )
            ->when(
                value: $this->getArchiveStatus(),
                callback: fn (Builder $query, NotificationRecipientArchiveStatus $value): Builder => match ($value) {
                    NotificationRecipientArchiveStatus::Archived => $query->archived(),
                    NotificationRecipientArchiveStatus::Unarchived => $query->unarchived(),
                },
            );
    }

    public function getUserId(): ?int
    {
        return isset($this->data['user_id']) ? (int) $this->data['user_id'] : null;
    }

    public function getCategoryId(): ?int
    {
        return isset($this->data['category_id']) ? (int) $this->data['category_id'] : null;
    }

    public function getReadStatus(): ?NotificationRecipientReadStatus
    {
        $readStatus = $this->data['read_status'] ?? null;

        return $readStatus ? NotificationRecipientReadStatus::from($readStatus) : null;
    }

    public function getArchiveStatus(): ?NotificationRecipientArchiveStatus
    {
        $archiveStatus = $this->data['archive_status'] ?? null;

        return $archiveStatus ? NotificationRecipientArchiveStatus::from($archiveStatus) : null;
    }
}
