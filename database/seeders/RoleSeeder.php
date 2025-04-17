<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $role = \Spatie\Permission\Models\Role::query()->create([
            'name' => 'Admin',
        ]);

        $role->syncPermissions(\Spatie\Permission\Models\Permission::all());
    }
}
