<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\Component\Pages\BaseEditPage;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;


class Edit extends BaseEditPage
{
    protected static string $view = 'livewire.admin.category.edit';

    public function getModel(): Model
    {
        return new Category;
    }
}
