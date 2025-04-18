<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationRecipientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->notification->uuid,
            'title' => $this->notification->title,
            'content' => strip_tags($this->notification->content),
            'recipient_id' => $this->recipient_id,
            'created_by' => $this->notification->user->name,
            'scheduled_date' => $this->notification->scheduled_date?->format('Y-m-d'),
            'scheduled_time' => $this->notification->scheduled_time,
            'viewed_at' => $this->viewed_at?->format('d/m/Y à\\s H:i'),
            'readed_at' => $this->readed_at?->format('d/m/Y à\\s H:i'),
            'created_at' => $this->notification->created_at->format('d/m/Y à\\s H:i'),
        ];
    }
}
