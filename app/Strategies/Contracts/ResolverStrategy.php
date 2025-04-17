<?php

namespace App\Strategies\Contracts;

interface ResolverStrategy
{
    public function resolve(array $data): mixed;
}
