<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\Component\Pages\BaseEditPage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

final class Edit extends BaseEditPage
{
    protected static string $view = 'livewire.admin.role.edit';

    public function getModel(): Model
    {
        return new Role;
    }
}
