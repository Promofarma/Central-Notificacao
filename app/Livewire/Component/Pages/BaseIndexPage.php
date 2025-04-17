<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages;

use App\Livewire\Component\Pages\Concerns\HasCreateButton;
use App\Livewire\Component\Pages\Concerns\InteractsWithAuthenticatedUser;
use App\Livewire\Component\Pages\Concerns\ProvidesModelNames;
use App\Livewire\Component\Pages\Contracts\HasModelContract;
use App\Livewire\Component\Pages\Enums\ResourceOperation;
use App\Livewire\Ui\Toast\Toast;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

abstract class BaseIndexPage extends Panel implements HasModelContract, HasForms, HasTable
{
    use ProvidesModelNames;
    use InteractsWithForms;
    use InteractsWithTable;
    use InteractsWithAuthenticatedUser;
    use HasCreateButton;

    protected const string DATE_FORMAT = 'd/m/y à\\s H:i';

    public function getTitle(): ?string
    {
        return $this->getTranslatedPluralModelName();
    }

    public function getHeaderButtons(): array
    {
        return $this->canCreate($this->getSingularModelName()) ? [$this->getCreateButton()] : [];
    }



    public function table(Table $table): Table
    {
        return $table
            ->query($this->getQuery())
            ->columns([
                ...$this->getTableColumns(),
                ...$this->getTimestampColumns(),
            ])
            ->filters($this->getTableFilters())
            ->groups($this->getTableGroups())
            ->actions([
                ...$this->getTableActions(),
                ...$this->getDefaultTableActions(),
            ])
            ->deferLoading(true)
            ->paginated(false);
    }

    public function canAccess(): bool
    {
        return $this->canViewAny($this->getSingularModelName());
    }

    protected function getQuery(): Builder
    {
        return $this->getModel()->query();
    }

    protected function getTableColumns(): array
    {
        return [];
    }

    protected function getTableFilters(): array
    {
        return [];
    }

    protected function getTableActions(): array
    {
        return [];
    }

    protected function getTableGroups(): array
    {
        return [];
    }

    protected function getCreatedAtColumn(): TextColumn
    {
        return TextColumn::make('created_at')
            ->label('Data de Criação')
            ->date(static::DATE_FORMAT);
    }

    protected function getUpdatedAtColumn(): TextColumn
    {
        return TextColumn::make('updated_at')
            ->label('Última Atualização')
            ->date(static::DATE_FORMAT);
    }

    protected function getTimestampColumns(): array
    {
        return [
            $this->getCreatedAtColumn(),
            $this->getUpdatedAtColumn(),
        ];
    }

    protected function getEditAction(): Action
    {
        return Action::make('edit')
            ->hiddenLabel()
            ->icon('heroicon-m-pencil')
            ->tooltip('Editar')
            ->url(fn(Model $record): string => route($this->getResourceRouteName(ResourceOperation::Edit), $record))
            ->visible($this->canUpdate($this->getSingularModelName()));
    }

    protected function getDeleteAction(): Action
    {
        return Action::make('delete')
            ->hiddenLabel()
            ->modalHeading('Remover')
            ->icon('heroicon-m-trash')
            ->tooltip('Remover')
            ->requiresConfirmation()
            ->action(function (Model $record): void {
                try {
                    $record->delete();
                    Toast::success('Operação concluída com sucesso!')->now();
                } catch (QueryException $e) {
                    Toast::exception($e);

                    return;
                }
            })
            ->visible($this->canDelete($this->getSingularModelName()));
    }

    protected function getDefaultTableActions(): array
    {
        return [
            $this->getEditAction(),
            $this->getDeleteAction(),
        ];
    }
}
