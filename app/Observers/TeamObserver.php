<?php

namespace App\Observers;

use App\Models\Team;

final class TeamObserver
{
    public function created(Team $team): void
    {
        $team->users()->attach($team->leader_id);
    }
}
