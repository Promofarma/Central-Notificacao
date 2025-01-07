<?php

declare(strict_types=1);

namespace Illuminate\Contracts\View;

use Illuminate\Contracts\Support\Renderable;

interface View extends Renderable
{
    public function layout(): static;

    public function title(): static;
}
