<?php

declare(strict_types=1);

namespace App\Filters\Enums;

enum FilterEvent: string
{
    public const UPDATING = 'filter-updating';

    public const UPDATED = 'filter-updated';

    public const RESETED = 'filter-reseted';
}
