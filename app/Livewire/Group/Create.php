<?php

namespace App\Livewire\Group;

use App\Livewire\Component\Pages\BaseCreatePage;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;

final class Create extends BaseCreatePage
{
    protected static string $view = 'livewire.group.create';

    public function getModel(): Model
    {
        return new Group;
    }
}
