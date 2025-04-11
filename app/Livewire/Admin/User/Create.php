<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Component\Pages\BaseCreatePage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

final class Create extends BaseCreatePage
{
    protected static string $view = 'livewire.admin.user.create';

    public function getModel(): Model
    {
        return new User;
    }
}
