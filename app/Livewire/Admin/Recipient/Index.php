<?php

namespace App\Livewire\Admin\Recipient;

use App\Livewire\Component\Pages\BaseIndexPage;
use App\Models\Recipient;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns;

final class Index extends BaseIndexPage
{
    protected static string $view = 'livewire.admin.recipient.index';

    public function getModel(): Model
    {
        return new Recipient;
    }

    protected function getTableColumns(): array
    {
        return [
            Columns\TextColumn::make('name')
                ->label('Nome')
                ->searchable(),

            Columns\TextColumn::make('email')
                ->label('E-mail')
                ->searchable(),
        ];
    }
}
