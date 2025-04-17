<?php

namespace App\Livewire\Admin\Permission;

use App\Livewire\Component\Pages\BaseCreatePage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

final class Create extends BaseCreatePage
{
    protected static string $view = 'livewire.admin.permission.create';

    public function getModel(): Model
    {
        return new Permission;
    }
}
