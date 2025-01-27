<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Enums\NotificationRecipientArchiveStatus;
use App\Enums\NotificationRecipientReadStatus;
use App\Filters\BaseFilterComponent;
use App\Models\Category;
use App\Models\User;
use Filament\Forms\Components;

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

            $this->withHintClearAction(Components\Radio::make('read_status'))
                ->label('Status de leitura')
                ->reactive()
                ->options(NotificationRecipientReadStatus::toArray()),
        ];
    }
}
