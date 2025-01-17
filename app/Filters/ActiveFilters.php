<?php

declare(strict_types=1);

namespace App\Filters;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;

class ActiveFilters
{
    public function __construct(
        protected readonly array $components
    ) {
    }

    public function getComponents(): array
    {
        return $this->components;
    }

    public function getMappedFilterComponents(): array
    {
        return array_map(function (Component $component) {
            $label = $component->getLabel() ?? $this->formatLabel($component->getStatePath(false));
            $state = $component->getState();

            if ($component instanceof Select) {
                $state = $this->getSelectedOptionLabels($component);
            }

            return [
                'label' => $label,
                'state' => is_array($state) ? $this->convertStateToString($state) : $state,
            ];
        }, $this->getComponents());
    }

    public function getFilledFilterComponents(): array
    {
        return array_filter($this->getMappedFilterComponents(), fn (array $component): bool => filled($component['state']));
    }

    public function all(): array
    {
        return $this->getFilledFilterComponents();
    }

    private function formatLabel(string $statePath): string
    {
        $label = ucfirst(str_replace('_', ' ', $statePath));

        return __($label);
    }

    private function convertStateToString(array $values): ?string
    {
        $filteredValues = array_values(array_filter($values));

        if (count($filteredValues) === 0) {
            return null;
        }

        return implode(' & ', $filteredValues);
    }

    private function getSelectedOptionLabels(Component $component): string|array|null
    {
        $selectedValues = $component->getState();

        if (blank($selectedValues)) {
            return $component->isMultiple() ? [] : null;
        }

        $options = $component->getOptions();

        if (!$component->isMultiple()) {
            return $options[$selectedValues];
        }

        return array_map(fn (string $selectedValue): string => $options[$selectedValue], $selectedValues);
    }
}
