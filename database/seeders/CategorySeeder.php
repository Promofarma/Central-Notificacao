<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    protected array $categories = [
        'Compras e Insumos',
        'Manutenção e Financeiro',
        'Logística e Estoque',
        'Comunicação e Marketing',
        'Treinamento e Padronização',
        'Organização e Operacional',
    ];

    public function run(): void
    {
        foreach ($this->categories as $index => $category) {
            Category::query()->create([
                'name' => $category,
                'icon' => 'box',
            ]);
        }
    }
}
