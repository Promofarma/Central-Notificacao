<?php

declare(strict_types=1);

namespace App\FormSchema;

use App\FormSchema\Contracts\FormSchemaContract;
use Illuminate\Support\Str;

final class PermissionFormSchema implements FormSchemaContract
{
    public function getComponents(): array
    {
        return [
            \Filament\Forms\Components\TextInput::make('name')
                ->label('Nome')
                ->required()
                ->maxLength(60)
                ->dehydrateStateUsing(fn(string $state): string => trim(Str::lower($state))),
        ];
    }
}
