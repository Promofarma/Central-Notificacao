<?php

declare(strict_types=1);

namespace App\Filters;

use App\Helpers\FormatCacheKey;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Livewire\Component;

/**
 * @property \Filament\Forms\Form $form
 */
abstract class BaseFilterComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public const FILTER_UPDATING_EVENT = 'filter-updating';

    public const FILTER_UPDATED_EVENT = 'filter-updated';

    public const FILTER_RESETED_EVENT = 'filter-reseted';

    public ?array $filterData = [];

    abstract protected function getView(): string;

    abstract protected function getFormSchema(): array;

    protected function getCacheFilterKey(): string
    {
        return FormatCacheKey::format(static::class);
    }

    protected function getViewData(): array
    {
        return [];
    }

    protected function getPersistFiltersInSession(): bool
    {
        return true;
    }

    protected function withHintClearAction(Components\Component $component): Components\Component
    {
        return $component->hintAction(
            action: Action::make('clear')
                ->label('Limpar')
                ->link()
                ->disabled(fn (mixed $state = null): bool => blank($state))
                ->action(function (Components\Component $component): void {
                    $component->fill();
                    // Generate the filterData based on the form state
                    $this->putFilterDataInSession();

                    $this->dispatch(static::FILTER_RESETED_EVENT, $component->getStatePath(false));
                })
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('filterData')
            ->schema($this->getFormSchema());
    }

    public function mount(): void
    {
        $cachedFilterData = ($this->getPersistFiltersInSession() && session($this->getCacheFilterKey()) ? session($this->getCacheFilterKey()) : []);

        $this->form->fill($cachedFilterData);
    }

    public function render(): View|Factory
    {
        return view($this->getView(), [
            'activeFilters' => (new ActiveFilters($this->form->getComponents()))->all(),
            ...$this->getViewData(),
        ]);
    }

    public function updatingFilterData(): void
    {
        $this->dispatch(static::FILTER_UPDATING_EVENT);
    }

    public function updatedFilterData(mixed $value, string $property): void
    {
        if (str_contains($property, '.')) {
            $property = preg_replace('/\.[a-zA-Z0-9]+/', '', $property);
            $value = array_key_exists($property, $this->filterData) ? $this->filterData[$property] : [$property => $value];
        }

        $this->putFilterDataInSession();

        $this->dispatch(static::FILTER_UPDATED_EVENT, [$property, $value]);
    }

    public function handleFilterReset(): void
    {
        $this->form->fill();

        if ($this->getPersistFiltersInSession()) {
            session()->forget($this->getCacheFilterKey());
        }

        $this->dispatch(static::FILTER_RESETED_EVENT);
    }

    private function putFilterDataInSession(): void
    {
        if ($this->getPersistFiltersInSession()) {
            session()->put($this->getCacheFilterKey(), $this->filterData);
        }
    }
}
