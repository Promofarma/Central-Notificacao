<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected array $categories = [
        'Gestão de Compras e Insumos',
        'Manutenção e Gestão Financeira',
        'Controle de Logística e Estoque',
        'Comunicação e Estratégias de Marketing',
        'Treinamento e Padrões Operacionais',
        'Organização e Operações Internas',
        'Avisos e Informações Importantes',
        'Destaques do Mês',
        'Relatório de Abertura do Mês',
        'Destaque: Foto da Loja TOP',
        'Conquistas e Medalhas',
        'Campanhas da Rede',
    ];

    public function run(): void
    {
        foreach (array_values($this->categories) as $name) {
            Category::create(['name' => $name]);
        }
    }
}
