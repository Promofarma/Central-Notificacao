<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages\Enums;

enum CanOperation: string
{
    case ViewAny = 'view any';

    case View = 'view';

    case Create = 'create';

    case Update = 'update';

    case Delete = 'delete';
}
