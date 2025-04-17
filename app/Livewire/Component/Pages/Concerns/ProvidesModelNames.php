<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages\Concerns;

use App\Livewire\Component\Pages\Enums\ResourceOperation;
use Illuminate\Support\Str;

trait ProvidesModelNames
{
    public function getSingularModelName(): string
    {
        return Str::singular(class_basename($this->getModel()::class));
    }

    public function getPluralModelName(): string
    {
        return Str::plural(class_basename($this->getModel()::class));
    }

    public function getTranslatedSingularModelName(): string
    {
        return trans($this->getSingularModelName());
    }

    public function getTranslatedPluralModelName(): string
    {
        return trans($this->getPluralModelName());
    }

    public function getResourceRouteName(ResourceOperation $operation): string
    {
        return sprintf('%s.%s', strtolower($this->getSingularModelName()), $operation->value);
    }
}
