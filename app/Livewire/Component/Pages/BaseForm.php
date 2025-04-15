<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages;

use App\FormSchema\Contracts\FormSchemaContract;
use App\Livewire\Component\Pages\Concerns\InteractsWithAuthenticatedUser;
use App\Livewire\Component\Pages\Concerns\ProvidesModelNames;
use App\Livewire\Component\Pages\Contracts\HasModelContract;
use App\Livewire\Component\Pages\Enums\ResourceOperation;
use App\View\Components\Ui\Button;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Attributes\Locked;

/**
 * @property Form $form
 */
abstract class BaseForm extends Panel implements HasModelContract, HasForms
{
    use ProvidesModelNames;
    use InteractsWithForms;
    use InteractsWithAuthenticatedUser;

    public ?array $data = [];

    #[Locked]
    public ?Model $record = null;

    public function getHeaderButtons(): array
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

    public function getViewData(): array
    {
        return [
            'formId' => $this->getFormId(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema($this->getFormSchema()->getComponents())
            ->model($this->getRecord())
            ->operation(
                operation: $this->getResourceOperation()->value,
            );
    }

    protected function getFormSchema(): FormSchemaContract
    {
        $formSchemaClassName = sprintf(
            '\\App\\FormSchema\\%sFormSchema',
            $this->getSingularModelName()
        );

        if (! class_exists($formSchemaClassName)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'A class [%s] not found',
                    $formSchemaClassName
                )
            );
        }

        return new $formSchemaClassName();
    }

    public function canAccess(): bool
    {
        $resource = $this->getSingularModelName();

        return match ($this->getResourceOperation()) {
            ResourceOperation::Edit => $this->canUpdate($resource),
            ResourceOperation::Create  => $this->canCreate($resource),
            default => throw new \InvalidArgumentException('Invalid Resource Operation'),
        };
    }

    public function mount(int|string|null $id = null): void
    {
        parent::mount();

        $this->resolveModel($id);
    }

    public function getRecord(): ?Model
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
