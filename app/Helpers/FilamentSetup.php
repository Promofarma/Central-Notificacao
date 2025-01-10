<?php

declare(strict_types=1);

namespace App\Helpers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

class FilamentSetup
{
    protected const DATE_FORMAT = 'd/m/Y';

    public function configureColors(): self
    {
        FilamentColor::register([
            'primary' => Color::Red,
            'secondary' => Color::Slate,
        ]);

        return $this;
    }

    public function configureFormFields(): self
    {
        TextInput::configureUsing(function (TextInput $component): void {
            $component->autocomplete(false);
        });

        DatePicker::configureUsing(function (DatePicker $component): void {
            $component->prefixIcon('lucide-calendar')
                ->native(false)
                ->placeholder(today()->format(static::DATE_FORMAT))
                ->displayFormat(static::DATE_FORMAT);
        });

        return $this;
    }

    public function configureNotification(): self
    {
        Notification::configureUsing(function (Notification $notification): void {
            $notification->view('components.ui.notification');
        });

        return $this;
    }
}
