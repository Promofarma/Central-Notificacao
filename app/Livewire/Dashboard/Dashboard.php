<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Livewire\Ui\Page\Page;

class Dashboard extends Page
{
    protected static string $layout = 'components.layouts.app';

    protected static string $view = 'livewire.dashboard.dashboard';

    protected static ?string $title = 'Dashboard';
}
