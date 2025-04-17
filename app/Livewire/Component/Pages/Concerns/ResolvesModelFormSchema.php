<?php declare(strict_types=1);

namespace App\Livewire\Component\Pages\Concerns;

use App\FormSchema\Contracts\FormSchemaContract;
use InvalidArgumentException;

trait ResolvesModelFormSchema
{
    protected function getFormSchemaClass(): FormSchemaContract
    {
        $formSchemaClassName = sprintf(
            '\\App\\FormSchema\\%sFormSchema',
            $this->getSingularModelName()
        );

        if (! class_exists($formSchemaClassName)) {
            throw new InvalidArgumentException(
                sprintf(
                    'A class [%s] not found',
                    $formSchemaClassName
                )
            );
        }

        return new $formSchemaClassName();
    }
}
