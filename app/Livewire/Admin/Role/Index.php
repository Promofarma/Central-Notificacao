<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\Component\Pages\BaseIndexPage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Filament\Tables\Columns;
use Illuminate\Support\Collection;

final class Index extends BaseIndexPage
{
    protected static string $view = 'livewire.admin.role.index';

    public function getModel(): Model
    {
        return new Role;
    }

    protected function getTableColumns(): array
    {
        return [
            Columns\TextColumn::make('name')
                ->label('Nome'),

            Columns\TextColumn::make('permissions.name')
                ->label('Permissões vinculadas')
                ->badge()
                ->limitList(1)
                ->tooltip(fn($record): string => $record->permissions->pluck('name')->implode(', '))
                ->placeholder('N/A'),
        ];
    }
}
