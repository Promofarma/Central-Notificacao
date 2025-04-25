<?php

namespace App\Filters\Concerns;

use App\Filters\Enums\FilterEvent;
use App\Helpers\FormatCacheKey;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Session;

/**
 * @property Form $form
 */
trait HasFilterData
{
    use InteractsWithForms;

    public ?array $filterData = [];

    protected function getFormSchema(): array
    {
        return [];
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('filterData')
            ->schema($this->getFormSchema());
    }

    public function mountHasFilterData(): void
    {
        if (! $this instanceof HasForms) {
            throw new \InvalidArgumentException('HasFilterData trait must be used with HasForms trait.');
        }

        $this->form->fill(
            state: $this->getCachedFilterData()
        );
    }

    public function updatingHasFilterData(): void
    {
        $this->dispatch(FilterEvent::UPDATING);
    }

    public function updatedHasFilterData(string $property, mixed $value = null): void
    {
        $property = str_replace('filterData.', '', $property);

        if (str_contains($property, '.')) {
            $property = preg_replace('/\.[a-zA-Z0-9]+/', '', $property);
            $value = array_key_exists($property, $this->filterData) ? $this->filterData[$property] : [$property => $value];
        }

        $this->saveFilterDataToSession();

        $this->dispatch(FilterEvent::UPDATED, [$property, $value]);
    }

    public function handleResetFilter(): void
    {
        if (blank(array_filter($this->filterData))) {
            return;
        }

        $this->form->fill();

        if (filled($this->getCachedFilterData())) {
            Session::forget($this->getCacheFilterKey());
        }

        $this->dispatch(FilterEvent::RESETED);
    }

    public function getCacheFilterKey(): string
    {
        return FormatCacheKey::format(self::class);
    }

    public function getCachedFilterData(): array
    {
        return Session::get($this->getCacheFilterKey(), []);
    }

    private function saveFilterDataToSession(): void
    {
        Session::put($this->getCacheFilterKey(), $this->filterData);
    }
}
