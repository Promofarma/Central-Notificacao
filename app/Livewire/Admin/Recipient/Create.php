<?php

namespace App\Livewire\Admin\Recipient;

use App\Livewire\Component\Pages\BaseIndexPage;
use App\Models\Recipient;
use Illuminate\Database\Eloquent\Model;

final class Create extends BaseIndexPage
{
    protected static string $view = 'livewire.admin.recipient.create';

    public function getModel(): Model
    {
        return new Recipient;
    }
}
