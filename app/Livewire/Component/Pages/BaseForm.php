<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages;

use App\FormSchema\Contracts\FormSchemaContract;
use App\Livewire\Component\Pages\Concerns\InteractsWithAuthenticatedUser;
use App\Livewire\Component\Pages\Concerns\ProvidesModelNames;
use App\Livewire\Component\Pages\Concerns\ResolvesModelFormSchema;
use App\Livewire\Component\Pages\Contracts\HasModelContract;
use App\Livewire\Component\Pages\Enums\ResourceOperation;
use App\View\Components\Ui\Button;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Attributes\Locked;
use InvalidArgumentException;

/**
 * @property Form $form
 */
abstract class BaseForm extends Panel implements HasForms, HasModelContract
{
    use InteractsWithAuthenticatedUser;
    use InteractsWithForms;
    use ProvidesModelNames;
    use ResolvesModelFormSchema;

    public ?array $data = [];

    #[Locked]
    public ?Model $record = null;

    final public function getHeaderButtons(): array
    {
        return [
            $this->getBackButton(),
            $this->getSaveButton(),
        ];
    }

    protected function getBackButton(): string
    {
        return BladeCompiler::renderComponent(
            new Button(
                text: 'Voltar',
                icon: 'arrow-uturn-left',
                color: 'gray',
                href: route($this->getResourceRouteName(ResourceOperation::Index))
            )
        );
    }

    protected function getSaveButton(): string
    {
        return BladeCompiler::renderComponent(
            new Button(
                type: 'submit',
                text: 'Salvar',
                icon: 'check',
                formId: $this->getFormId(),
                wireTarget: 'handleOnSubmit',
            )
        );
    }

    final public function getViewData(): array
    {
        return [
            'formId' => $this->getFormId(),
        ];
    }

    final public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema($this->getFormSchemaClass()->getComponents())
            ->model($this->getRecord())
            ->operation(
                operation: $this->getResourceOperation()->value,
            );
    }

    final public function canAccess(): bool
    {
        $resource = $this->getSingularModelName();

        return match ($this->getResourceOperation()) {
            ResourceOperation::Edit => $this->canUpdate($resource),
            ResourceOperation::Create  => $this->canCreate($resource),
            default => throw new InvalidArgumentException('Invalid Resource Operation'),
        };
    }

    final public function mount(int|string|null $id = null): void
    {
        parent::mount();

        $this->resolveModel($id);
    }

    final public function getRecord(): ?Model
    {
        return $this->record;
    }

    protected function resolveModel(int|string|null $id = null): void
    {
        $this->record = $id
            ? $this->getModel()->findOrFail($id)
            : null;

        $this->form->fill($this->record?->toArray());
    }

    protected function getResourceOperation(): ResourceOperation
    {
        return ResourceOperation::from(
            strtolower(class_basename(static::class))
        );
    }

    protected function getFormId(): string
    {
        return sprintf('%s-%s', $this->getResourceOperation()->value, md5(static::class));
    }
}
