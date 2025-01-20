<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class ForgetCacheManyKeys
{
    protected const WILDCARD = '*';

    public function __construct(
        protected readonly string $key,
        protected readonly array $values,
    ) {
    }

    public static function make(string $key, array $values): self
    {
        return new self(key: $key, values: $values);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getFormattedValues(): array
    {
        return array_map(
            callback: fn (string $value): string => str_replace(
                static::WILDCARD,
                $value,
                $this->getKey()
            ),
            array: $this->getValues()
        );
    }

    public function forgetAll(): void
    {
        foreach ($this->getFormattedValues() as $formattedKey) {
            Cache::forget($formattedKey);
        }
    }
}
