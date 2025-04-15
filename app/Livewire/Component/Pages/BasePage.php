<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages;

use App\Livewire\Component\Pages\Concerns\CanAccess;
use App\Livewire\Component\Pages\Contracts\AccessControlContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

abstract class BasePage extends Component implements AccessControlContract
{
    use CanAccess;

    protected static string $view;

    protected static string $layout;

    protected static ?string $title = null;

    public function getView(): string
    {
        return static::$view;
    }

    public function getViewData(): array
    {
        return [];
    }

    public function getHeaderButtons(): array
    {
        return [];
    }

    public function getLayout(): string
    {
        return static::$layout;
    }

    public function getTitle(): ?string
    {
        return static::$title;
    }

    public function mount(): void
    {
        abort_unless($this->canAccess(), 403);
    }

    public function render(): View|Factory
    {
        return view(
            view: $this->getView(),
            data: $this->mergeDefaultViewData($this->getViewData()),
        )
            ->title($this->getTitle())
            ->layout($this->getLayout());
    }

    protected function mergeDefaultViewData(): array
    {
        return array_merge([
            'title' => $this->getTitle(),
            'headerButtons' => $this->getHeaderButtons(),
        ], $this->getViewData());
    }
}
