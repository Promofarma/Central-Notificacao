<?php

declare(strict_types=1);

namespace App\DTO;

abstract class AbstractDTO
{
    abstract public static function fromArray(array $data): self;

    public function toArray(): array
    {
        $properties = get_class_vars(static::class);

        $data = [];

        foreach (array_keys($properties) as $property) {
            if (!property_exists(static::class, $property)) {
                throw new \BadMethodCallException('Property ' . $property . ' is not allowed');
            }

            $data[$property] = $this->{$property};
        }

        return $data;
    }
}
