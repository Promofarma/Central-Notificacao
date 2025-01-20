<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Enums\NotificationRecipientArchiveStatus;
use App\Enums\NotificationRecipientReadStatus;
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

            $this->withHintClearAction(Components\Radio::make('read_status'))
                ->label('Status de leitura')
                ->reactive()
                ->options(NotificationRecipientReadStatus::toArray()),

            $this->withHintClearAction(Components\Radio::make('archive_status'))
                ->label('Status de arquivamento')
                ->reactive()
                ->options(NotificationRecipientArchiveStatus::toArray()),
        ];
    }
}
