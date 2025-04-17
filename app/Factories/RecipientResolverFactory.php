<?php

namespace App\Factories;

use App\Strategies\Contracts\ResolverStrategy;
use App\Strategies\DirectRecipientsResolver;
use App\Strategies\GroupRecipientsResolver;

final class RecipientResolverFactory
{
    public static function make(string $type): ResolverStrategy
    {
        return match ($type) {
            'recipients' => new DirectRecipientsResolver(),
            'groups' => new GroupRecipientsResolver(),
            default => throw new \InvalidArgumentException('Target resolver is invalid'),
        };
    }
}
