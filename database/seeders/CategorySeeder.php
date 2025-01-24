<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected array $categories = [
        'Compras e Insumos',
        'Manutenção e Financeiro',
        'Logística e Estoque',
        'Comunicação e Marketing',
        'Treinamento e Padronização',
        'Organização e Operacional',
        'Avisos Importantes',
    ];

    public function run(): void
    {
        foreach (array_values($this->categories) as $category) {
            Category::query()->create([
                'name' => $category,
                'icon' => 'box',
            ]);
        }
    }
}
