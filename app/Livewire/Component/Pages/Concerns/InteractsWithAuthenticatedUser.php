<?php

declare(strict_types=1);

namespace App\Livewire\Component\Pages\Concerns;

use App\Livewire\Component\Pages\Enums\CanOperation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait InteractsWithAuthenticatedUser
{
    public function user(string $name = null): User
    {
        return Auth::guard($name)->user();
    }

    public function can(CanOperation $operation, string $resource): bool
    {
        return $this->user()->can(
            sprintf('%s %s', $operation->value, strtolower($resource))
        );
    }

    public function canViewAny(string $resource): bool
    {
        return $this->can(CanOperation::ViewAny, $resource);
    }

    public function canView(string $resource): bool
    {
        return $this->can(CanOperation::View, $resource);
    }

    public function canCreate(string $resource): bool
    {
        return $this->can(CanOperation::Create, $resource);
    }

    public function canUpdate(string $resource): bool
    {
        return $this->can(CanOperation::Update, $resource);
    }

    public function canDelete(string $resource): bool
    {
        return $this->can(CanOperation::Delete, $resource);
    }
}
