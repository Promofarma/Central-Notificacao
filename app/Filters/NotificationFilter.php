<?php

namespace App\Filters;

use App\Filters\Contracts\FilterContract;
use Illuminate\Database\Eloquent\Builder;

final class NotificationFilter implements FilterContract
{
    public function __construct(
        protected array $data
    ) {}

    public function apply(Builder $query): Builder
    {
        return $query;
    }
}
