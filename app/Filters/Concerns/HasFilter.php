<?php

declare(strict_types=1);

namespace App\Filters\Concerns;

use App\Filters\Contracts\Filterable;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    public function scopeFilter(Builder $query, Filterable $filter): Builder
    {
        return $filter->apply($query);
    }
}
