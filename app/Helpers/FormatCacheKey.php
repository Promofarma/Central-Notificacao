<?php

declare(strict_types=1);

namespace App\Helpers;

class FormatCacheKey
{
    public static function format(string $key): string
    {
        $basename = explode('\\', $key);

        array_pop($basename);

        return implode('-', array_map('strtolower', $basename));
    }
}
