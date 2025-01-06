<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    protected array $categories = [
        'Midias',
        'Promoções',
        'Comunicados',
    ];

    protected array $icons = [
        'image',
        'circle-percent',
        'message-square',
    ];

    public function run(): void
    {
        foreach ($this->categories as $index => $category) {
            Category::query()->create([
                'name' => $category,
                'icon' => $this->icons[$index],
            ]);
        }
    }
}
