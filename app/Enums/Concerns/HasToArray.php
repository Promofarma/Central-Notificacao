<?php

declare(strict_types=1);

namespace App\Enums\Concerns;

trait HasToArray
{
    public static function toArray(): array
    {
        $cases = self::cases();

        return array_reduce($cases, function (array $carry, object $item): array {
            $carry[$item->value] = __($item->name);

            return $carry;
        }, []);
    }
}
