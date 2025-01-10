<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Page;

use App\Livewire\Ui\Page\Concerns\HasResolveResourceName;
use App\View\Components\Ui\Button;
use Illuminate\View\Compilers\BladeCompiler;

abstract class Index extends Page
{
    use HasResolveResourceName;

    protected static string $layout = 'components.layouts.app';

    protected function getTitle(): ?string
    {
        return __($this->resolveResourceNamePlural());
    }

    protected function getHeaderActions(): array
    {
        return [
            BladeCompiler::renderComponent(new Button(
                text: 'Novo',
                icon: 'plus',
                color: 'white',
                href: route(name: $this->routeName('create')),
            )),
        ];
    }
}
