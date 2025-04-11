<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    private array $operations = [
        'view any',
        'view',
        'create',
        'update',
        'delete',
    ];

    private array $features = [
        'user',
        'recipient',
        'team',
        'category',
        'role',
        'group',
        'permission',
        'notification',
    ];

    public function run(): void
    {
        foreach ($this->generatePermissions() as $name) {
            \Spatie\Permission\Models\Permission::query()->create([
                'name' => $name,
            ]);
        }
    }

    private function generatePermissions(): array
    {
        $permissions = [];

        foreach ($this->operations as $operation) {
            foreach ($this->features as $feature) {
                $permissions[] = "{$operation} {$feature}";
            }
        }

        return $permissions;
    }
}
