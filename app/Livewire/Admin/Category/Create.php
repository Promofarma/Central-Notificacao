<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\Component\Pages\BaseCreatePage;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

final class Create extends BaseCreatePage
{
    protected static string $view = 'livewire.admin.category.create';

    public function getModel(): Model
    {
        return new Category;
    }
}
