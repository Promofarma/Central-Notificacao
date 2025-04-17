<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages\Contracts;

interface AccessControlContract
{
    public function canAccess(): bool;
}
