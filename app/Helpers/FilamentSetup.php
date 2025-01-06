<?php

declare(strict_types=1);

namespace App\Helpers;

use Filament\Forms\Components\TextInput;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

class FilamentSetup
{
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

        return $this;
    }
}
