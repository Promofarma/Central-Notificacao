<?php

declare(strict_types=1);

namespace App\Forms\Contracts;

interface FormSchemable
{
    public function getSchema(): array;
}
