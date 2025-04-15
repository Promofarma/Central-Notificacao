<?php

namespace App\Forms\Components;

use Closure;
use Filament\Forms\Components\Concerns\HasDescriptions;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Field;

class TargetType extends Field
{
    use HasOptions;
    use HasDescriptions;

    protected string $view = 'forms.components.target-type';

    protected array $icons = [];

    public function icons(array | Closure $icons): self
    {
        $this->icons = $icons;

        return $this;
    }

    public function hasIcon($value): bool
    {
        return array_key_exists($value, $this->getIcons());
    }

    public function getIcon($value): string
    {
        return $this->getIcons()[$value] ?? null;
    }

    public function getIcons(): array
    {
        return $this->icons;
    }
}
