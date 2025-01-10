<?php

declare(strict_types=1);

namespace App\DTO;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NotificationDTO extends AbstractDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly int $category_id,
        public readonly ?int $user_id = null,
        public readonly ?string $scheduled_at = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: self::formatTitle($data['title']),
            content: trim($data['content']),
            category_id: (int) $data['category_id'],
            user_id: Auth::id(),
            scheduled_at: $data['scheduled_at'] ?? null,
        );
    }

    private static function formatTitle(string $title): string
    {
        return Str::of($title)->ucfirst()
            ->trim()
            ->toString();
    }
}
