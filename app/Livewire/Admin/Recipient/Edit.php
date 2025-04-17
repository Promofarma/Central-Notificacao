<?php

namespace App\Livewire\Admin\Recipient;

use App\Livewire\Component\Pages\BaseEditPage;
use App\Models\Recipient;
use Illuminate\Database\Eloquent\Model;

final class Edit extends BaseEditPage
{
    protected static string $view = 'livewire.admin.recipient.edit';

    public function getModel(): Model
    {
        return new Recipient;
    }
}
