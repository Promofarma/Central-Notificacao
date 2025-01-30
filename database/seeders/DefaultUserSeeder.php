<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    protected array $defaultUsers = [
        ['name' => 'Vinicius Coutinho', 'email' => 'vinicius@promofarma.com.br'],
        ['name' => 'Noreply', 'email' => 'noreply@promofarma.com.br'],
        ['name' => 'Erica Molina', 'email' => 'erica.molina@promofarma.com.br'],
        ['name' => 'Anizio',  'email' => 'anizio@promofarma.com.br'],
        ['name' => 'Janaina Costa',  'email' => 'janaina.costa@promofarma.com.br'],
        ['name' => 'Tatiana Galete',  'email' => 'tatiana.galete@promofarma.com.br'],
        ['name' => 'Raquel Silva',  'email' => 'raquel.silva@promofarma.com.br'],
        ['name' => 'Vanessa Lumy',  'email' => 'vanessa.lumy@promofarma.com.br'],
        ['name' => 'Raquel Fernandes',  'email' => 'raquel.fernandes@promofarma.com.br'],
        ['name' => 'Everton Silva',  'email' => 'everton.silva@promofarma.com.br'],
        ['name' => 'Antonio Correia',  'email' => 'antonio.correia@promofarma.com.br'],
        ['name' => 'Isabella Fabris',  'email' => 'isabella.fabris@promofarma.com.br'],
        ['name' => 'Denis',  'email' => 'supevisor@promofarma.com.br'],
    ];

    public function run(): void
    {
        foreach ($this->defaultUsers as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make(12345),
            ]);
        }
    }
}
