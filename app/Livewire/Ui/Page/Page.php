<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Page;

use App\Livewire\Ui\Page\Concerns\HasAccess;
use App\Livewire\Ui\Page\Contracts\Accessable;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

abstract class Page extends Component implements Accessable
{
    use HasAccess;

    protected static string $layout;

    protected static string $view;

    protected static ?string $title = null;

    protected function getLayout(): string
    {
        return static::$layout;
    }

    protected function getView(): string
    {
        return static::$view;
    }

    protected function getViewData(): array
    {
        return [];
    }

    protected function getTitle(): ?string
    {
        return static::$title;
    }

    public function mount(): void
    {
        abort_unless(static::canAccess(), 403);
    }

    public function render(): View|Factory
    {
        return view(
            $this->getView(),
            [
                'title' => $this->getTitle(),
                ...$this->getViewData(),
            ]
        )
            ->layout($this->getLayout())
            ->title($this->getTitle());
    }
}
