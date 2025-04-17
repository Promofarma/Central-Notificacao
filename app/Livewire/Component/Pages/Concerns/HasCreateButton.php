<?php

namespace App\Livewire\Component\Pages\Concerns;

use App\View\Components\Ui\Button;
use Illuminate\View\Compilers\BladeCompiler;
use App\Livewire\Component\Pages\Enums\ResourceOperation;

trait HasCreateButton
{
    protected function getCreateButton(): string
    {
        return  BladeCompiler::renderComponent(
            component: new Button(
                text: "Adicionar {$this->getTranslatedSingularModelName()}",
                href: route($this->getResourceRouteName(ResourceOperation::Create)),
                icon: 'plus',
            )
        );
    }
}
