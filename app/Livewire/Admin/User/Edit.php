<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Component\Pages\BaseEditPage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

final class Edit extends BaseEditPage
{
    protected static string $view = 'livewire.admin.user.edit';

    public function getModel(): Model
    {
        return new User;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['role']);

        return $data;
    }
}
