<?php declare(strict_types=1);

namespace App\Livewire\Group\Drawer;

use App\Livewire\Ui\Drawer\DrawerForm;
use App\Models\Group;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

final class Edit extends DrawerForm
{
    public function getModel(): Model
    {
        return new Group;
    }

    protected function getOperation(): string
    {
        return 'edit';
    }

    public function render(): Factory|View
    {
        return view('livewire.group.drawer.edit');
    }
}
