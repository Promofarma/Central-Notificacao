<?php declare(strict_types=1);

namespace App\Livewire\Ui\Contracts;

interface Openable
{
    public function open(): void;

    public function close(): void;

    /** @return array<string,string> */
    public function registerListeners(): array;
}
