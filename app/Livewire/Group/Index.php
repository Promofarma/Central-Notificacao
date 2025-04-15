<?php

namespace App\Livewire\Group;

use App\Livewire\Component\Pages\Concerns\InteractsWithAuthenticatedUser;
use App\Livewire\Component\Pages\Panel;
use App\Models\Group;
use App\View\Components\Ui\Button;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

final class Index extends Panel
{
    use InteractsWithAuthenticatedUser;

    protected static string $view = 'livewire.group.index';

    protected static ?string $title = 'Grupos';

    public function getHeaderButtons(): array
    {
        return [
            BladeCompiler::renderComponent(
                component: new Button(
                    text: 'Novo Grupo',
                    href: route('group.create'),
                    icon: 'plus',
                    visible: $this->canCreate('notification')
                ),
            ),
        ];
    }

    #[Computed]
    #[On('group-deleted')]
    public function userGroups(): Collection
    {
        return Group::ownedBy(Auth::id())
            ->with('recipients')
            ->withCount('recipients')
            ->get();
    }
}
