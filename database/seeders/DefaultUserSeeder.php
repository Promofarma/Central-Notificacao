<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            'name' => 'Vinicius Coutinho',
            'email' => 'vinicius@promofarma.com.br',
            'password' => Hash::make('12345'),
        ]);
    }
}
