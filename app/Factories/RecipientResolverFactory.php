<?php

declare(strict_types=1);

namespace App\Factories;

use App\Strategies\Contracts\ResolverStrategy;
use App\Strategies\DirectRecipientsResolver;
use App\Strategies\GroupRecipientsResolver;
use InvalidArgumentException;

final class RecipientResolverFactory
{
    public static function make(string $type): ResolverStrategy
    {
        return match ($type) {
            'recipients' => new DirectRecipientsResolver,
            'groups' => new GroupRecipientsResolver,
            default => throw new InvalidArgumentException('Target resolver is invalid'),
        };
    }
}
