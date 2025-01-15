<?php

declare(strict_types=1);

namespace App\Filters\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filterable
{
    public function apply(Builder $builder): Builder;
}
