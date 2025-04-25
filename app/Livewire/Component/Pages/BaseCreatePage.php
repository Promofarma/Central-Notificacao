<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages;

use App\Livewire\Component\Pages\Enums\ResourceOperation;
use App\Livewire\Ui\Toast\Toast;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

abstract class BaseCreatePage extends BaseForm
{
    final public function getTitle(): ?string
    {
        return sprintf('Adicionar %s', $this->getTranslatedSingularModelName());
    }

    protected function beforeValidate(): void
    {
    }

    protected function afterValidate(): void
    {
    }

    protected function beforeCreate(): void
    {
    }

    protected function afterCreate(): void
    {
    }

    protected function getCreatedNotification(): string
    {
        return 'Operação concluída com sucesso!';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }

    final public function handleOnSubmit(): void
    {
        try {
            DB::beginTransaction();

            $this->beforeValidate();

            $data = $this->form->getState();

            $this->afterValidate();

            $data = $this->mutateFormDataBeforeCreate($data);

            $this->beforeCreate();

            $this->record = $this->getModel()->create($data);

            $this->afterCreate();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();

            Toast::exception($e);

            return;
        }

        Toast::success($this->getCreatedNotification())->now();

        $this->redirect(
            url: route($this->getResourceRouteName(ResourceOperation::Index)),
            navigate: true,
        );
    }
}
