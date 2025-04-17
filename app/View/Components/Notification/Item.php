<?php

declare(strict_types=1);

namespace App\View\Components\Notification;

use App\Models\Notification;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Number;
use Illuminate\View\Component;

final class Item extends Component
{
    public function __construct(
        public Notification $notification,
    ) {}

    public function getPercentageRead(): string
    {
        $readCount = $this->notification->recipients_read_count;

        $recipientsCount = $this->notification->recipients_count;

        $percentage = ($readCount / $recipientsCount) * 100;

        return Number::percentage($percentage);
    }

    public function render(): View|Closure|string
    {
        return view('components.notification.item');
    }
}
