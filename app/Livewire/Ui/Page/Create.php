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
abstract class Create extends Page implements HasForms
{
    use HasResolveResourceName;
    use InteractsWithForms;

    protected static string $layout = 'components.layouts.app';

    public ?Model $record = null;

    public ?array $data = [];

    abstract protected function getModel(): string;

    abstract protected function getFormSchema(): array;

    protected function afterValidate(): void
    {
    }

    protected function beforeValidate(): void
    {
    }

    protected function beforeCreate(): void
    {
    }

    protected function afterCreate(): void
    {
    }

    protected function prepareDataForCreate(array $data): array
    {
        return $data;
    }

    protected function handleRecordCreate(array $data): Model
    {
        $modelClass = $this->getModel();

        if (!is_subclass_of($modelClass, Model::class)) {
            throw new \Exception('Class must be an instance of Model');
        }

        $model = new $modelClass();

        return $model->create($data);
    }

    protected function getFormId(): string
    {
        return sprintf('%s-create', strtolower($this->resolveResourceName()));
    }

    protected function getTitle(): ?string
    {
        return 'Criar ' . __($this->resolveResourceNameSingular());
    }

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

    protected function getViewData(): array
    {
        return [
            'formId' => $this->getFormId(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->model($this->getModel())
            ->schema($this->getFormSchema());
    }

    public function mount(): void
    {
        parent::mount();

        $this->form->fill();
    }

    public function create(): void
    {
        try {
            $this->beforeValidate();

            $data = $this->form->getState();

            $this->afterValidate();

            $data = $this->prepareDataForCreate($data);

            $this->beforeCreate();

            $this->record = $this->handleRecordCreate($data);

            $this->afterCreate();
        } catch(QueryException $exception) {
            Toast::exception($exception)->now();
        }
    }
}
