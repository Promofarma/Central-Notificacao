<?php

declare(strict_types=1);

namespace App\Livewire\Notification;

use App\Livewire\Ui\Page\Page;
use App\Models\Notification;
use App\View\Components\Ui\Button;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Attributes\Locked;

class Show extends Page
{
    protected static string $layout = 'components.layouts.app';

    protected static string $view = 'livewire.notification.show';

    #[Locked]
    public Notification $notification;

    protected function getTitle(): ?string
    {
        return $this->notification->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            BladeCompiler::renderComponent(new Button(
                text: 'Voltar',
                icon: 'arrow-left',
                color: 'white',
                href: route('notification.index'),
            )),
        ];
    }

    public function mount(?Notification $notification = null): void
    {
        parent::mount();

        $this->notification = $notification->load(['recipients.recipient', 'attachments']);
    }
}
