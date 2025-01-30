<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected array $categories = [
        'Compras e Insumos',
        'Manutenção Financeira',
        'Logística e Estoque',
        'Marketing e Comunicação',
        'Treinamento e Padrões',
        'Operações Internas',
        'Avisos e Informações',
        'Destaques do Mês',
        'Relatório Mensal',
        'Foto da Loja TOP',
        'Conquistas e Premiações',
        'Campanhas da Rede',
        'Precificação',
    ];

    public function run(): void
    {
        foreach (array_values($this->categories) as $name) {
            Category::create(['name' => $name]);
        }
    }
}
