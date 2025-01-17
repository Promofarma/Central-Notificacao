<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use Filament\Forms\Components;
use App\Filters\BaseFilterComponent;
use App\Models\Category;
use App\Models\User;

class Filter extends BaseFilterComponent
{
    protected function getView(): string
    {
        return 'livewire.recipient.filter';
    }

    protected function getFormSchema(): array
    {
        return [
            $this->withHintClearAction(Components\Select::make('user_id'))
                ->label('Solicitante')
                ->reactive()
                ->native(false)
                ->options(User::pluck('name', 'id')),

            $this->withHintClearAction(Components\Select::make('category_id'))
                ->label('Categoria')
                ->reactive()
                ->native(false)
                ->options(Category::pluck('name', 'id')),

            $this->withHintClearAction(Components\Radio::make('is_read'))
                ->label('Exibir notificações lidas?')
                ->reactive()
                ->boolean(
                    trueLabel: 'Sim',
                    falseLabel: 'Não',
                ),

            $this->withHintClearAction(Components\Radio::make('is_archived'))
                ->label('Exibir notificações arquivadas?')
                ->reactive()
                ->boolean(
                    trueLabel: 'Sim',
                    falseLabel: 'Não',
                ),
        ];
    }
}
