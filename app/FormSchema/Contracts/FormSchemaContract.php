<?php

declare(strict_types=1);

namespace App\FormSchema\Contracts;

interface FormSchemaContract
{
    public function getComponents(): array;
}
