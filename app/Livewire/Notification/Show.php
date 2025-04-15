<?php

declare(strict_types=1);

namespace App\Livewire\Notification;

use App\Livewire\Component\Pages\Concerns\InteractsWithAuthenticatedUser;
use App\Livewire\Component\Pages\Panel;
use App\Models\Notification;
use App\View\Components\Ui\Button;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Attributes\Locked;

final class Show extends Panel
{
    use InteractsWithAuthenticatedUser;

    protected static string $view = 'livewire.notification.show';

    #[Locked]
    public Notification $notification;

    public function getTitle(): ?string
    {
        return $this->notification->title;
    }

    public function getHeaderButtons(): array
    {
        return [
            BladeCompiler::renderComponent(new Button(
                text: 'Voltar',
                icon: 'arrow-left',
                color: 'gray',
                href: route('notification.index'),
            )),

            BladeCompiler::renderComponent(new Button(
                text: 'Editar',
                icon: 'pencil',
                href: route('notification.edit', $this->notification),
            )),
        ];
    }

    public function mount(?Notification $notification = null): void
    {
        parent::mount();

        $this->notification = $notification->load(['recipients.recipient', 'attachments']);
    }
}
