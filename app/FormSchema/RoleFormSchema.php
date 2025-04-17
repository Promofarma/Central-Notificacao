<?php

declare(strict_types=1);

namespace App\FormSchema;

use App\FormSchema\Contracts\FormSchemaContract;

final class RoleFormSchema implements FormSchemaContract
{
    public function getComponents(): array
    {
        return [
            \Filament\Forms\Components\TextInput::make('name')
                ->label('Nome')
                ->required()
                ->maxLength(60),

            \Filament\Forms\Components\CheckboxList::make('permissions')
                ->columns(3)
                ->bulkToggleable()
                ->relationship('permissions', 'name')
                ->visibleOn('edit'),
        ];
    }
}
