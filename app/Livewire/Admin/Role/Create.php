<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\Component\Pages\BaseCreatePage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

final class Create extends BaseCreatePage
{
    protected static string $view = 'livewire.admin.role.create';

    public function getModel(): Model
    {
        return new Role;
    }
}
