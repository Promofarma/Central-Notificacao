<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Page\Concerns;

use Illuminate\Support\Str;

trait HasResolveResourceName
{
    protected const TOKENS = ['\\', 'App', 'Livewire', 'Index', 'Create', 'Edit', 'Delete'];

    public function resolveResourceName(): string
    {
        $classBasename = static::class;

        return str_replace(static::TOKENS, '', $classBasename);
    }

    public function resolveResourceNamePlural(): string
    {
        return Str::of($this->resolveResourceName())->plural()->toString();
    }

    public function resolveResourceNameSingular(): string
    {
        return $this->resolveResourceName();
    }

    public function routeName(string $action): string
    {
        return sprintf('%s.%s', strtolower($this->resolveResourceName()), $action);
    }
}
