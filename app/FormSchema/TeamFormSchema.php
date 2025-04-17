<?php

namespace App\FormSchema;

use App\FormSchema\Contracts\FormSchemaContract;
use App\Models\Category;
use App\Models\User;
use Filament\Forms\Components;
use Illuminate\Support\Str;

final class TeamFormSchema implements FormSchemaContract
{
    public function getComponents(): array
    {
        return [
            Components\TextInput::make('name')
                ->label('Nome')
                ->required()
                ->maxLength(60)
                ->dehydrateStateUsing(fn(string $state): string => Str::of($state)->ucfirst()->trim()->value()),

            Components\Select::make('leader_id')
                ->label('Líder')
                ->required()
                ->options(User::pluck('name', 'id')),

            Components\CheckboxList::make('users')
                ->label('Membros')
                ->relationship('users', 'name')
                ->options(User::withoutCurrentUserAndBot()->pluck('name', 'id'))
                ->bulkToggleable()
                ->columns(3)
                ->visibleOn('edit'),

            Components\CheckboxList::make('categories')
                ->label('Categorias')
                ->relationship('categories', 'name')
                ->options(Category::pluck('name', 'id'))
                ->bulkToggleable()
                ->columns(3)
                ->visibleOn('edit'),
        ];
    }
}
