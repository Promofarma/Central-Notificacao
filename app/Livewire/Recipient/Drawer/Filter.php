<?php

declare(strict_types=1);

namespace App\Livewire\Recipient\Drawer;

use App\Enums\NotificationRecipientReadStatus;
use App\Filters\Concerns\HasFilterData;
use App\Livewire\Ui\Drawer\Drawer;
use App\Models\User;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * @property Form $form
 */
final class Filter extends Drawer implements HasForms
{
    use HasFilterData;

    protected function getFormSchema(): array
    {
        return [
            Components\Select::make('user_id')
                ->label('Solicitante')
                ->searchable()
                ->reactive()
                ->native(false)
                ->options(User::orderBy('name')->pluck('name', 'id')),

            Components\Radio::make('read_status')
                ->label('Status de leitura')
                ->reactive()
                ->options(NotificationRecipientReadStatus::toArray()),
        ];
    }

    public function render(): Factory|View
    {
        return view('livewire.recipient.drawer.filter');
    }
}
