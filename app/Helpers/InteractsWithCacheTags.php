<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Cache\TaggedCache;
use Illuminate\Support\Facades\Cache;

trait InteractsWithCacheTags
{
    public function getCacheTags(): TaggedCache
    {
        return Cache::tags($this->getTags());
    }

    public function invalidateCache(): void
    {
        $this->getCacheTags()->flush();
    }

    public function invalidateKey(string $key): void
    {
        $this->getCacheTags()->forget($key);
    }

    protected function getTags(): array
    {
        return [];
    }
}
