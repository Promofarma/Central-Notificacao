<?php

namespace App\Strategies;

use App\Models\Group;
use App\Strategies\Contracts\ResolverStrategy;

final class GroupRecipientsResolver implements ResolverStrategy
{
    public function resolve(array $data): mixed
    {
        return Group::getUserIdsFromGroups($data['recipient_ids'])->toArray();
    }
}
