<?php declare(strict_types=1);

namespace App\Livewire\Ui\Drawer;

use App\Livewire\Component\Pages\Concerns\ProvidesModelNames;
use App\Livewire\Component\Pages\Concerns\ResolvesModelFormSchema;
use App\Livewire\Component\Pages\Contracts\HasModelContract;
use App\Livewire\Ui\Toast\Toast;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;

/**
 * @property Form $form
 */
abstract class DrawerForm extends Drawer implements HasForms, HasModelContract
{
    use AuthorizesRequests;
    use InteractsWithForms;
    use ProvidesModelNames;
    use ResolvesModelFormSchema;

    #[Locked]
    public ?Model $record = null;

    public ?array $data = [];

    final public function open(int|string|null $id = null): void
    {
        parent::open();

        if ($id) {
            $this->record = $this->getModel()->query()->findOrFail($id);
        }

        $this->form->fill(
            state: $this->record?->toArray()
        );
    }

    abstract protected function getOperation(): string;

    final public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->model($this->record)
            ->operation($this->getOperation())
            ->schema($this->getFormSchemaClass()->getComponents());
    }

    final public function handleOnSubmit(): void
    {
        $data = $this->form->getState();

        DB::beginTransaction();

        try {
            $this->authorize($this->getResolvedOperationName());

            if ($this->record === null){
                $this->record = $this->getModel()->create($data);

                $this->close();
            } else {
                $this->record->update($data);

                $this->record->refresh();

                $this->form->fill($this->record->toArray());
            }

            $this->dispatch($this->getLowerSingularModelName() . '-'. match($this->getOperation()) {
                'create' => 'created',
                'edit' => 'updated',
            });

            DB::commit();
        } catch (QueryException | AuthorizationException $exception) {
            DB::rollBack();

            Toast::exception($exception)->now();
        }
    }

    private function getLowerSingularModelName(): string
    {
        return strtolower($this->getSingularModelName());
    }

    private function getResolvedOperationName(): string
    {
        $operation = $this->getOperation();

        return ($operation === 'edit' ? 'update' : $operation) . ' ' . $this->getLowerSingularModelName();
    }
}
