<?php

namespace App\Filters\Concerns;

use App\Filters\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;

trait HasFiltered
{
    public function scopeFilter(Builder $query, FilterContract $filter): Builder
    {
        return $filter->apply($query);
    }
}
