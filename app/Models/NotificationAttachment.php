<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;

class NotificationAttachment extends Model
{
    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class);
    }

    public function isImage(): bool
    {
        return in_array($this->extension, ['jpg', 'jpeg', 'png', 'gif']);
    }

    public function isPdf(): bool
    {
        return $this->extension === 'pdf';
    }

    protected function path(): Attribute
    {
        return Attribute::get(fn (string $value): string => asset('storage/'.$value));
    }

    protected function size(): Attribute
    {
        return Attribute::get(fn (int $value): string => Number::fileSize($value));
    }
}
