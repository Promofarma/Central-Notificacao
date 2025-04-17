<?php

namespace App\Observers;

use App\Models\Recipient;

final class RecipientObserver
{
    public function creating(Recipient $recipient): void
    {
        $lastId = Recipient::latest('id')->value('id');

        $recipient->id = $lastId + 1;
    }
}
