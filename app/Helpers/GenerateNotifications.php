<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\NotificationSchedule;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

abstract class GenerateNotifications
{
    public function handle(NotificationSchedule $schedule): void
    {
        $period = CarbonPeriod::create($schedule->start_date, $schedule->end_date);

        $toCollection = collect($period->toArray());

        /** Remove a primeira data para não gerar notificação duplicada, pois ela já foi gerada */
        $toCollection->shift();

        $results = $this->filter($toCollection, $schedule)
            ->map(fn (Carbon $date): array => [
                ...$this->toArray($date),
                'shipping_at' => $schedule->shipping_hour,
            ])
            ->values();

        $schedule->results()->createMany($results);
    }

    protected function toArray(Carbon $date): array
    {
        return [
            'scheduled_at' => $date->format('Y-m-d'),
        ];
    }

    abstract protected function filter(Collection $collection, NotificationSchedule $schedule): Collection;
}
