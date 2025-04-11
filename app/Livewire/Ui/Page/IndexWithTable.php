<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Page;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

abstract class IndexWithTable extends Index implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getModel()->query())
            ->columns(array_merge(
                $this->getTableColumns(),
                $this->getTimestampsColumns(),
            ))
            ->actions(array_merge(
                $this->getTableActions(),
                $this->getDefaultActions(),
            ));
    }

    protected function getModel(): Model
    {
        $class = '\\App\\Models\\' . $this->resolveResourceName();

        if (!class_exists($class)) {
            throw new \DomainException('A class [' . $class . '] not exists');
        }

        return (new $class);
    }

    protected function getTableColumns(): array
    {
        return [];
    }

    protected function getTimestampsColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->label('Criado em')
                ->date('d/m/y H:i'),

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Atualizado em')
                ->date('d/m/y H:i'),
        ];
    }

    protected function getTableActions(): array
    {
        return [];
    }

    protected function getDefaultActions(): array
    {
        return [
            Tables\Actions\Action::make('edit')
                ->label('Editar')
                ->icon('heroicon-s-pencil')
                ->url(fn(Model $record): string => route($this->routeName('edit'), $record)),

            Tables\Actions\Action::make('delete')
                ->label('Deletar')
                ->icon('heroicon-s-trash')
                ->requiresConfirmation(),
        ];
    }
}
