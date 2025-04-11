<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Category extends Model
{
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, table: 'team_categories');
    }
}
