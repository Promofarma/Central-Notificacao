<?php

declare(strict_types=1);

namespace App\Livewire\Notification\Drawer;

use App\Filters\Concerns\HasFilterData;
use App\Livewire\Ui\Drawer\Drawer;
use App\Models\Recipient;
use App\Models\User;
use Filament\Forms\Components;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

final class Filter extends Drawer implements HasForms
{
    use HasFilterData;

    public function render(): Factory|View
    {
        return view('livewire.notification.drawer.filter');
    }

    protected function getFormSchema(): array
    {
        return [
            Components\TextInput::make('title')
                ->label('Título')
                ->live(onBlur: true)
                ->placeholder('Pesquise pelo título da notificação'),

            Components\Select::make('user_ids')
                 ->label('Usuário')
                 ->live(onBlur: true)
                 ->multiple()
                 ->options($this->getCurrentUser()->getTeamUsers()),

            Components\Select::make('recipient_ids')
                 ->label('Destinatários')
                 ->live(onBlur: true)
                 ->multiple()
                 ->options(Recipient::orderBy('id')->pluck('name', 'id'))
                 ->optionsLimit(Recipient::count()),

            Components\Select::make('category_id')
                 ->label('Categoria')
                 ->live(onBlur: true)
                 ->native(false)
                 ->options($this->getCurrentUser()->getTeamCategories()),

            Components\Grid::make()
                ->reactive()
                ->statePath('created_at')
                ->schema([
                    Components\DatePicker::make('from')
                         ->label('Dê'),
                    Components\DatePicker::make('to')
                         ->label('Até'),
                ]),
        ];
    }

    private function getCurrentUser(): User
    {
        return Auth::user();
    }
}
