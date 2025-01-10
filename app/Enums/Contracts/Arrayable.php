<?php

declare(strict_types=1);

namespace App\Enums\Contracts;

interface Arrayable
{
    public static function toArray(): array;
}
