<?php

declare(strict_types=1);

namespace App\Actions;

use App\Helpers\GenerateNotifications;
use App\Models\NotificationSchedule;
use Illuminate\Support\Collection;

final class GenerateDailyNotifications extends GenerateNotifications
{
    protected function filter(Collection $collection, NotificationSchedule $schedule): Collection
    {
        return $collection;
    }
}
