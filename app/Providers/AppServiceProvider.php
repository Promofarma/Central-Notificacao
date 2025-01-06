<?php

declare(strict_types=1);

namespace App\Providers;

use App\Helpers\FilamentSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->configureEloquent();

        (new FilamentSetup())
            ->configureColors()
            ->configureFormFields();
    }

    private function configureEloquent(): void
    {
        Model::unguard();

        Model::shouldBeStrict();
    }
}
