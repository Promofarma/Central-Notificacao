<?php

namespace App\Livewire\Admin\Team;

use App\Livewire\Component\Pages\BaseEditPage;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

final class Edit extends BaseEditPage
{
    protected static string $view = 'livewire.admin.team.edit';

    public function getModel(): Model
    {
        return new Team;
    }
}
