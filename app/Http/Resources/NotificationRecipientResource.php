<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \Illuminate\Support\Carbon $scheduled_at
 * @property \Illuminate\Support\Carbon $read_at
 * @property \Illuminate\Support\Carbon $created_at
 */
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
            'scheduled_at' => $this->notification->scheduled_at?->format('Y-m-d'),
            'viewed_at' => $this->viewed_at?->format('d/m/Y à\\s H:i'),
            'readed_at' => $this->readed_at?->format('d/m/Y à\\s H:i'),
            'created_at' => $this->notification->created_at->format('d/m/Y à\\s H:i'),
        ];
    }
}
