<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

trait FormatsTimestamps
{
    protected function formattedCreatedAt(): Attribute
    {
        return Attribute::get(function (mixed $value, array $attributes): string {
            return Carbon::parse($attributes['created_at'])->format('d/m/Y à\\s H:i');
        });
    }

    protected function formattedUpdatedAt(): Attribute
    {
        return Attribute::get(function (mixed $value, array $attributes): string {
            return Carbon::parse($attributes['updated_at'])->format('d/m/Y à\\s H:i');
        });
    }
}
