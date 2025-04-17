<?php

namespace App\Livewire\Group;

use App\Livewire\Component\Pages\BaseEditPage;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;

final class Edit extends BaseEditPage
{
    protected static string $view = 'livewire.group.edit';

    public function getModel(): Model
    {
        return new Group;
    }
}
