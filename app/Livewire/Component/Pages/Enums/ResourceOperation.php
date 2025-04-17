<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages\Enums;

enum ResourceOperation: string
{
    case Index = 'index';

    case Create = 'create';

    case Edit = 'edit';
}
