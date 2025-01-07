<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Page\Concerns;

trait HasAccess
{
    public static function canAccess(): bool
    {
        return true;
    }
}
