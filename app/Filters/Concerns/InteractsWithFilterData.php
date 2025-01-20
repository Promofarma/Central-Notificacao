<?php

declare(strict_types=1);

namespace App\Filters\Concerns;

use App\Filters\BaseFilterComponent;
use App\Helpers\FormatCacheKey;
use App\Livewire\Ui\Toast\Toast;

trait InteractsWithFilterData
{
    public array $filterData = [];

    public function getListeners(): array
    {
        return [
            BaseFilterComponent::FILTER_UPDATED_EVENT => 'onFilterDataUpdated',
            BaseFilterComponent::FILTER_RESETED_EVENT => 'onFilterDataReseted',
        ];
    }

    public function onFilterDataUpdated(array $data): void
    {
        [$property, $value] = $data;

        $this->filterData[$property] = $value;

        $this->afterOnFilterDataUpdated();
    }

    public function onFilterDataReseted(string $key = null): void
    {
        if (filled($key) && isset($this->filterData[$key])) {
            $this->filterData[$key] = null;
        }

        $this->reset('filterData');

        $this->afterOnFilterDataReseted();

        Toast::success('Filtros limpos com sucesso!')->now();
    }

    public function mount(): void
    {
        parent::mount();

        $this->filterData = session(FormatCacheKey::format(static::class), []);
    }

    public function getFilterData(): array
    {
        return $this->filterData;
    }

    public function afterOnFilterDataUpdated(): void
    {
    }

    public function afteronFilterDataReseted(): void
    {
    }
}
