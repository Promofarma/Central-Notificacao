<?php

namespace App\FormSchema;

use App\FormSchema\Contracts\FormSchemaContract;
use Filament\Forms\Components;

final class CategoryFormSchema implements FormSchemaContract
{
    public function getComponents(): array
    {
        return [
            Components\TextInput::make('name')
                ->label('Nome')
        ];
    }
}
