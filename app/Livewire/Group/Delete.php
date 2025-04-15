<?php

namespace App\Livewire\Group;

use App\Livewire\Ui\Toast\Toast;
use App\Models\Group;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class Delete extends Component
{
    use AuthorizesRequests;

    #[Locked]
    public Group $group;

    public function delete(): void
    {
        try {
            $this->authorize('delete group');

            $this->group->delete();

            $this->dispatch('group-deleted');

            Toast::success()->now();
        } catch (QueryException | AuthorizationException $exception) {
            Toast::exception($exception)->now();
        }
    }

    public function render(): Factory|View
    {
        return view('livewire.group.delete');
    }
}
