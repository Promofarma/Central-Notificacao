<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HasModelContract
{
    public function getModel(): Model;
}
