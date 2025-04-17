<?php declare(strict_types=1);

namespace App\Livewire\Ui\Drawer;

use App\Livewire\Ui\Concerns\HasOpenState;
use App\Livewire\Ui\Contracts\Openable;
use Livewire\Component;

abstract class Drawer extends Component implements Openable
{
    use HasOpenState;

    final public function registerListeners(): array
    {
        return [
            'open-drawer' => 'open',
            'close-drawer' => 'close',
        ];
    }
}
