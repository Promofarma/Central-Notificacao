<?php

namespace App\Livewire\Admin\Category;

use App\Livewire\Component\Pages\BaseIndexPage;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns;

final class Index extends BaseIndexPage
{
    protected static string $view = 'livewire.admin.category.index';

    public function getModel(): Model
    {
        return new Category;
    }

    protected function getTableColumns(): array
    {
        return [
            Columns\TextColumn::make('name')
                ->label('Nome')
                ->searchable(),
        ];
    }
}
