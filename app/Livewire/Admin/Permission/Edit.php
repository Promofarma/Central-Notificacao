<?php

namespace App\Livewire\Admin\Permission;

use App\Livewire\Component\Pages\BaseEditPage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

final class Edit extends BaseEditPage
{
    protected static string $view = 'livewire.admin.permission.edit';

    public function getModel(): Model
    {
        return new Permission;
    }
}
