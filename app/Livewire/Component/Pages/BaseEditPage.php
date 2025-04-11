<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages;

use App\Livewire\Ui\Toast\Toast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

abstract class BaseEditPage extends BaseForm
{
    public function getTitle(): ?string
    {
        return 'Editar';
    }

    protected function beforeValidate(): void {}

    protected function afterValidate(): void {}

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }

    protected function beforeSave(): void {}

    protected function afterSave(): void {}

    protected function getSavedNotification(): string
    {
        return 'Operação concluída com sucesso!';
    }

    public function handleSaveRecord(Model $record, array $data)
    {
        $record->update($data);

        return $record;
    }

    public function handleOnSubmit(): void
    {
        try {
            DB::beginTransaction();

            $this->beforeValidate();

            $data = $this->form->getState(afterValidate: function (): void {
                $this->afterValidate();
            });

            $data = $this->mutateFormDataBeforeSave($data);

            $this->beforeSave();

            $this->getRecord()->update($data);

            $this->afterSave();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();

            Toast::exception($e);

            return;
        }

        Toast::success($this->getSavedNotification())->now();
    }
}
