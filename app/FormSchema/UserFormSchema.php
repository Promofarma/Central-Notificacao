<?php

declare(strict_types=1);

namespace App\FormSchema;

use App\FormSchema\Contracts\FormSchemaContract;
use Filament\Forms\Components;
use Illuminate\Support\Str;

final class UserFormSchema implements FormSchemaContract
{
    public function getComponents(): array
    {
        return [
            Components\TextInput::make('name')
                ->label('Nome')
                ->required()
                ->maxLength(60)
                ->dehydrateStateUsing(fn(string $state): string => trim(Str::title($state)))
                ->placeholder('Digite nome completo'),

            Components\TextInput::make('email')
                ->label('E-mail')
                ->required()
                ->email()
                ->unique(ignoreRecord: true)
                ->placeholder('@promofarma.com.br')
                ->dehydrateStateUsing(fn(string $state): string => trim(Str::lower($state))),

            Components\TextInput::make('password')
                ->label('Senha')
                ->required()
                ->password()
                ->revealable()
                ->visibleOn('create')
                ->placeholder('Crie uma senha segura'),

            Components\Select::make('role')
                ->label('Função')
                ->required()
                ->relationship('roles', 'name')
                ->visibleOn('edit'),
        ];
    }
}
