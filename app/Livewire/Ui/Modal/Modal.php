<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Modal;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

abstract class Modal extends Component
{
    public bool $isOpen = false;

    #[On('open-modal')]
    public function open(): void
    {
        $this->isOpen = true;
    }

    #[On('close-modal')]
    public function close(): void
    {
        $this->isOpen = false;
    }

    abstract protected function getView(): string;

    protected function getViewData(): array
    {
        return [];
    }

    public function render(): View|Factory
    {
        return view($this->getView(), $this->getViewData());
    }
}
