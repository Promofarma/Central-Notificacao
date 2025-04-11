<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Page;

use App\Livewire\Ui\Page\Concerns\HasResolveResourceName;
use App\Livewire\Ui\Toast\Toast;
use App\View\Components\Ui\Button;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\View\Compilers\BladeCompiler;

/**
 * @property Form $form
 */
abstract class Edit extends Page implements HasForms
{
    use HasResolveResourceName;
    use InteractsWithForms;

    protected static string $layout = 'components.layouts.app';

    protected function getHeaderActions(): array
    {
        return [
            BladeCompiler::renderComponent(new Button(
                text: 'Voltar',
                icon: 'arrow-left',
                color: 'white',
                href: route($this->routeName('index')),
            )),

            BladeCompiler::renderComponent(new Button(
                type: 'submit',
                text: 'Salvar',
                icon: 'plus',
                color: 'success',
                formId: $this->getFormId(),
                wireTarget: 'create',
            )),
        ];
    }
}
