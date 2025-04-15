<?php

namespace App\Observers;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;

final class GroupObserver
{
    public function creating(Group $group): void
    {
        $group->user_id = Auth::id();
    }
}
