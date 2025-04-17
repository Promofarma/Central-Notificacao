<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Modal;

use App\Livewire\Ui\Concerns\HasOpenState;
use App\Livewire\Ui\Contracts\Openable;
use Livewire\Component;

abstract class Modal extends Component implements Openable
{
    use HasOpenState;

    final public function registerListeners(): array
    {
        return [
            'open-modal' => 'open',
            'close-modal' => 'close',
        ];
    }
}
