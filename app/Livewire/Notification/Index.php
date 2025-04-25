<?php

declare(strict_types=1);

namespace App\Livewire\Notification;

use App\Filters\Concerns\InteractsWithFilterData;
use App\Filters\NotificationFilter;
use App\Livewire\Component\Pages\Concerns\InteractsWithAuthenticatedUser;
use App\Livewire\Component\Pages\Panel;
use App\Queries\TeamMembersNotificationsQuery;
use App\View\Components\Ui\Button;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

final class Index extends Panel
{
    use InteractsWithAuthenticatedUser;
    use InteractsWithFilterData;

    protected static string $view = 'livewire.notification.index';

    protected static ?string $title = 'Notificações';

    public function getHeaderButtons(): array
    {
        return [
            BladeCompiler::renderComponent(
                component: new Button(
                    text: 'Filtros',
                    icon: 'funnel',
                    color: 'gray',
                    id: 'trigger',
                    alpineExtraAttributes: ['@click.prevent' => '$wire.dispatchTo(\'notification.drawer.filter\', \'open-drawer\')'],
                )
            ),

            BladeCompiler::renderComponent(
                component: new Button(
                    text: 'Adicionar Notificação',
                    href: route('notification.create'),
                    icon: 'plus',
                    visible: $this->canCreate('notification')
                ),
            ),
        ];
    }

    #[Computed]
    #[On('notification-updated')]
    #[On('notification-deleted')]
    public function notifications(): Collection
    {
        return (new TeamMembersNotificationsQuery(user: Auth::user()))->builder()
            ->filter(new NotificationFilter($this->getFilterData()))
            ->get();
    }
}
