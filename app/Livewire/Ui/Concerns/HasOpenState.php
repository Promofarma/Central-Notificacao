<?php declare(strict_types=1);

namespace App\Livewire\Ui\Concerns;

trait HasOpenState
{
    public bool $isOpen = false;

    public function open(): void
    {
        $this->isOpen = true;
    }

    public function close(): void
    {
        $this->isOpen = false;
    }

    public function registerListeners(): array
    {
        return [];
    }

    public function getListeners(): array
    {
        return $this->registerListeners();
    }
}
