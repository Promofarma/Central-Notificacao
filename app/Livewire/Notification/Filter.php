<?php

declare(strict_types=1);

namespace App\Livewire\Notification;

use App\Filters\BaseFilterComponent;
use App\Models\Category;
use App\Models\Recipient;
use Filament\Forms\Components;

final class Filter extends BaseFilterComponent
{
    protected function getView(): string
    {
        return 'livewire.notification.filter';
    }

    protected function getFormSchema(): array
    {
        return [
            $this->withHintClearAction(Components\TextInput::make('title'))
                ->label('Título')
                ->live(onBlur: true)
                ->placeholder('Pesquise pelo título da notificação'),

            $this->withHintClearAction(Components\Select::make('recipient_ids'))
                ->label('Destinatários')
                ->live(onBlur: true)
                ->multiple()
                ->options(Recipient::orderBy('id')->pluck('name', 'id'))
                ->optionsLimit(Recipient::count()),

            $this->withHintClearAction(Components\Select::make('category_id'))
                ->label('Categoria')
                ->live(onBlur: true)
                ->native(false)
                ->options(Category::pluck('name', 'id')),

            Components\Grid::make(1)
                ->reactive()
                ->statePath('created_at')
                ->schema([
                    $this->withHintClearAction(Components\DatePicker::make('from'))
                        ->label('Dê'),
                    $this->withHintClearAction(Components\DatePicker::make('to'))
                        ->label('Até'),
                ]),
        ];
    }
}
