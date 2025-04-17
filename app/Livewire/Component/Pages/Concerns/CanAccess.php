<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages\Concerns;

trait CanAccess
{
    public function canAccess(): bool
    {
        return true;
    }
}
