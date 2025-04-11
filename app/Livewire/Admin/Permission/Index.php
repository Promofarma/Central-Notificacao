<?php

namespace App\Livewire\Admin\Permission;

use App\Livewire\Component\Pages\BaseIndexPage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Filament\Tables\Columns;

final class Index extends BaseIndexPage
{
    protected static string $view = 'livewire.admin.permission.index';

    public function getModel(): Model
    {
        return new Permission;
    }

    protected function getTableColumns(): array
    {
        return [
            Columns\TextColumn::make('name')
                ->label('Nome'),
        ];
    }
}
