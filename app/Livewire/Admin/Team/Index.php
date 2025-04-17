<?php

namespace App\Livewire\Admin\Team;

use App\Livewire\Component\Pages\BaseIndexPage;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns;

final class Index extends BaseIndexPage
{
    protected static string $view = 'livewire.admin.team.index';

    public function getModel(): Model
    {
        return new Team;
    }

    protected function getTableColumns(): array
    {
        return [
            Columns\TextColumn::make('name')
                ->label('Nome')
                ->searchable(),

            Columns\TextColumn::make('leader.name')
                ->label('Líder')
                ->searchable(),

            Columns\TextColumn::make('users.name')
                ->label('Membros')
                ->badge()
                ->limitList(1)
                ->tooltip(fn($record) => $record->users->pluck('name')->implode(', '))
                ->placeholder('N/A'),

            Columns\TextColumn::make('categories.name')
                ->label('Categorias')
                ->badge()
                ->limitList(1)
                ->tooltip(fn($record) => $record->categories->pluck('name')->implode(', '))
                ->placeholder('N/A'),
        ];
    }
}
