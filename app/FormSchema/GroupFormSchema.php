<?php declare(strict_types=1);

namespace App\FormSchema;

use App\Enums\GroupStatus;
use App\FormSchema\Contracts\FormSchemaContract;
use App\Models\Group;
use Filament\Forms\Components;
use Illuminate\Support\Str;

final class GroupFormSchema implements FormSchemaContract
{
    public function getComponents(): array
    {
        return [
            Components\TextInput::make('name')
                ->label('Nome')
                ->required()
                ->unique(Group::class, 'name', ignoreRecord: true)
                ->maxLength(60)
                ->dehydrateStateUsing(fn(string $state): string => Str::of($state)->ucfirst()->trim()->value()),

            Components\Select::make('status')
                ->label('Status')
                ->required()
                ->options(GroupStatus::toArray())
                ->visibleOn('edit'),

            Components\CheckboxList::make('recipients')
                ->label('Lojas')
                ->required()
                ->searchable()
                ->bulkToggleable()
                ->columns(2)
                ->relationship('recipients', 'name')
                ->visibleOn('edit')
        ];
    }
}
