<?php

namespace App\Queries;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

final class TeamMembersNotificationsQuery
{
    public function __construct(
        private readonly User $user
    ) {}

    public function builder(): Builder
    {
        return Notification::query()
            ->with(['schedule', 'attachments', 'category', 'user:id,name'])
            ->withCount([
                'recipients',
                'recipients as recipients_read_count' => fn($query) => $query->read(),
                'attachments',
            ])
            ->whereIn('user_id', function ($query) {
                $query->select('user_id')
                    ->from('team_users')
                    ->whereIn('team_id', function ($subquery) {
                        $subquery->select('team_id')
                            ->from('team_users')
                            ->where('user_id', $this->user->id);
                    });
            })
            ->whereNull('parent_uuid')
            ->latest();
    }
}
