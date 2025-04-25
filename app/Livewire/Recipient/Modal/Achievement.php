<?php declare(strict_types=1);

namespace App\Livewire\Recipient\Modal;

use App\Livewire\Ui\Modal\Modal;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class Achievement extends Modal
{
    public function render(): Factory|View
    {
        return view('livewire.recipient.modal.achievement');
    }
}
