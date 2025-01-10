<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipient extends Model
{
    public function notifications(): HasMany
    {
        return $this->hasMany(NotificationRecipient::class);
    }
}
