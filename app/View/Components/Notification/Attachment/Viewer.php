<?php

declare(strict_types=1);

namespace App\View\Components\Notification\Attachment;

use App\Models\NotificationAttachment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Viewer extends Component
{
    public function __construct(
        public Collection $attachments
    ) {
    }

    public function getImages(): Collection
    {
        return $this->attachments->filter(fn (NotificationAttachment $attachment): bool => $attachment->isImage())
            ->map(fn (NotificationAttachment $attachment): array => [
                'imgSrc' => $attachment->path,
                'imgAlt'=> $attachment->file_name,
            ])
            ->values();
    }

    public function getFiles(): Collection
    {
        return $this->attachments->filter(fn (NotificationAttachment $attachment): bool => ! $attachment->isImage());
    }

    public function render(): View|Closure|string
    {
        return view('components.notification.attachment.viewer');
    }
}
