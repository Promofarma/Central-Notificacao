<?php

declare(strict_types=1);

namespace App\Forms\Schemas;

use App\Forms\Contracts\FormSchemable;
use App\Models\User;
use Filament\Forms\Components;

final class UserFormSchema implements FormSchemable
{
    public function getSchema(): array
    {
        return [
            Components\TextInput::make('name')
                ->label('Nome')
                ->required()
                ->maxLength(60)
                ->placeholder('Digite o nome do usuário'),

            Components\TextInput::make('email')
                ->label('E-mail')
                ->required()
                ->email()
                ->maxLength(255)
                ->unique(User::class, 'email')
                ->placeholder('usuário@promofarma.com.br'),

            Components\TextInput::make('password')
                ->label('Senha')
                ->required()
                ->password()
                ->revealable()
                ->placeholder('Digite uma senha para usuário'),

            Components\TextInput::make('confirm_password')
                ->label('Confirme a senha')
                ->required()
                ->password()
                ->revealable()
                ->same('password')
                ->placeholder('Confirme a senha do usuário')
        ];
    }
}
