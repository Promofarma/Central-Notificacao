<?php

declare(strict_types=1);

namespace App\Helpers;

class FormatCacheKey
{
    public static function format(string $key, int $level = 1): string
    {
        $basename = explode('\\', $key);

        for ($i = 0; $i <= $level; $i++) {
            array_pop($basename);
        }

        return implode('-', array_map('strtolower', $basename));
    }
}
