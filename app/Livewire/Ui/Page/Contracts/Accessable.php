<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Page\Contracts;

interface Accessable
{
    public static function canAccess(): bool;
}
