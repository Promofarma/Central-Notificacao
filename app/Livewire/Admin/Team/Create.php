<?php

namespace App\Livewire\Admin\Team;

use App\Livewire\Component\Pages\BaseCreatePage;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

final class Create extends BaseCreatePage
{
    protected static string $view = 'livewire.admin.team.create';

    public function getModel(): Model
    {
        return new Team;
    }
}
