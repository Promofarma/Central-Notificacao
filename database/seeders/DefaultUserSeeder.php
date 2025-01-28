<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    protected array $defaultUsers = [
        [
            'name' => 'Vinicius Coutinho',
            'email' => 'vinicius@promofarma.com.br',
            'password' => '12345',
        ],
        [
            'name' => 'Noreply',
            'email' => 'noreply@promofarma.com.br',
            'password' => 'Promo@2506',
        ],
        [
            'name' => 'Erica Molina',
            'email' => 'erica.molina@promofarma.com.br',
            'password' => '12345',
        ],
    ];

    public function run(): void
    {
        foreach ($this->defaultUsers as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
