<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Component\Pages\BaseIndexPage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns;

final class Index extends BaseIndexPage
{
    protected static string $view = 'livewire.admin.user.index';

    public function getModel(): Model
    {
        return new User;
    }

    protected function getTableColumns(): array
    {
        return [
            Columns\TextColumn::make('name')
                ->label('Nome')
                ->searchable()
                ->sortable(),

            Columns\TextColumn::make('email')
                ->label('E-mail')
                ->searchable(),

            Columns\TextColumn::make('roles.name')
                ->label('Função')
                ->badge()
                ->placeholder('N/A')
        ];
    }
}
