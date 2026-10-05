<?php

declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

final class NotificationDTO extends AbstractDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly string $type,
        public readonly int $category_id,
        public readonly ?int $user_id = null,
        public readonly ?Carbon $expires_at = null,
        public readonly ?string $scheduled_date = null,
        public readonly ?string $scheduled_time = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            content: trim($data['content']),
            type: $data['type'],
            category_id: (int) $data['category_id'],
            user_id: isset($data['user_id']) ? (int) $data['user_id'] : Auth::id(),
            expires_at: $data['expires_at'] ?? null,
            scheduled_date: $data['scheduled_date'] ?? null,
            scheduled_time: $data['scheduled_time'] ?? null,
        );
    }
}
