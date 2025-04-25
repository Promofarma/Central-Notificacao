<?php

declare(strict_types=1);

namespace App\Filters\Concerns;

use App\Filters\Enums\FilterEvent;
use App\Helpers\FormatCacheKey;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;

trait InteractsWithFilterData
{
    public ?array $filterData = [];

    public function getListeners(): array
    {
        return [
            FilterEvent::UPDATED => 'handleFilterDataUpdated',
            FilterEvent::RESETED => 'handleFilterDataReseted',
        ];
    }

    public function mountInteractsWithFilterData(): void
    {
        $this->filterData = Session::get(FormatCacheKey::format(self::class, level: 0), []);
    }

    public function handleFilterDataUpdated(array $payload): void
    {
        [$property, $value] = $payload;

        $this->filterData[$property] = $value;

        $this->afterFilterDataUpdated();
    }

    public function handleFilterDataReseted(): void
    {
        $this->reset('filterData');

        $this->afterFilterDataReseted();
    }

    public function getFilterData(): array
    {
        return $this->filterData;
    }

    #[Computed]
    public function countFilteredData(): int
    {
        return count(array_filter($this->filterData));
    }

    public function afterFilterDataUpdated(): void
    {
    }

    public function afterFilterDataReseted(): void
    {
    }
}
