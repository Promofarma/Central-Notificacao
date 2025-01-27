<?php

declare(strict_types=1);

namespace App\View\Components\Recipient;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Inbox extends Component
{
    public function __construct(
        public Collection $notificationRecipientItems,
    ) {
    }

    public function getGroupItems(): Collection
    {
        return $this->notificationRecipientItems->keys()
            ->flatMap(fn (string $groupName): array => [md5($groupName) => false]);
    }

    public function render(): View|Closure|string
    {
        return view('components.recipient.inbox');
    }
}
