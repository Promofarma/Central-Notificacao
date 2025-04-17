<?php

namespace App\FormSchema;

use App\FormSchema\Contracts\FormSchemaContract;
use App\Models\Recipient;
use Filament\Forms\Components;
use Illuminate\Support\Str;

final class RecipientFormSchema implements FormSchemaContract
{
    public function getComponents(): array
    {
        return [
            Components\TextInput::make('name')
                ->label('Nome')
                ->required()
                ->maxLength(60)
                ->dehydrateStateUsing(fn(string $state): string => Str::of($state)->ucfirst()->trim()->value()),

            Components\TextInput::make('email')
                ->label('E-mail')
                ->required()
                ->email()
                ->maxLength(255)
                ->unique(Recipient::class, 'email'),
        ];
    }
}
