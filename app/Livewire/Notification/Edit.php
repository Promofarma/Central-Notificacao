<?php

namespace App\Livewire\Notification;

use App\Livewire\Component\Pages\BaseEditPage;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;

final class Edit extends BaseEditPage
{
    protected static string $view = 'livewire.notification.edit';

    public function getModel(): Model
    {
        return new Notification;
    }
}
