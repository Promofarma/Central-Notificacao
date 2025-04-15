<?php

namespace App\Strategies;

use App\Models\Recipient;
use App\Strategies\Contracts\ResolverStrategy;

final class DirectRecipientsResolver implements ResolverStrategy
{
    public function resolve(array $data): mixed
    {
        return $data['send_to_all_recipients']
            ? Recipient::pluck('id')->toArray()
            : $data['recipient_ids'];
    }
}
