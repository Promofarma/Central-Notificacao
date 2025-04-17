<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\RecipientObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(RecipientObserver::class)]
final class Recipient extends Model
{
    public function notifications(): HasMany
    {
        return $this->hasMany(NotificationRecipient::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, table: 'group_recipients');
    }

    public function avatarUrl(): string
    {
        $name = urlencode(str_replace('Promofarma', '', $this->name));

        return 'https://ui-avatars.com/api/?background=e5e7eb&name=' . $name;
    }
}
