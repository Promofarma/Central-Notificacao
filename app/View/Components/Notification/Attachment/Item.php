<?php

declare(strict_types=1);

namespace App\View\Components\Notification\Attachment;

use App\Models\NotificationAttachment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Item extends Component
{
    public function __construct(
        public NotificationAttachment $attachment,
        public string $direction = 'row',
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.notification.attachment.item');
    }
}
