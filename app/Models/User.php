<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

final class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasRoles;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function leadingTeam(): HasOne
    {
        return $this->hasOne(Team::class, 'leader_id');
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, table: 'team_users');
    }


    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function scopeWithoutCurrentUserAndBot(Builder $query): Builder
    {
        return $query->whereNotIn('id', [Auth::id(), 2]);
    }

    public function getTeamCategories(): Collection
    {
        return $this->load('teams.categories')
            ->teams
            ->flatMap(fn(Team $team): Collection => $team->categories)
            ->unique('id')
            ->pluck('name', 'id');
    }
}
