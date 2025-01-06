<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipient;

class RecipientSeeder extends Seeder
{
    protected const UNAVAILABLE_IDS = [15, 63, 65];

    protected const PREFIX = 'Promofarma';

    public function run(): void
    {
        $fakeIds = range(1, 85);

        $ids = array_filter($fakeIds, fn ($id): bool => !in_array($id, [self::UNAVAILABLE_IDS]));

        foreach ($ids as $id) {
            Recipient::query()->create([
                'id' => $id,
                'name' => sprintf('%s %d', self::PREFIX, $id),
                'email' => $this->generateMail($id),
            ]);
        }
    }

    private function generateMail(int $id): string
    {
        $mail = sprintf('%s%d@%s.com.br', self::PREFIX, $id, self::PREFIX);

        return strtolower($mail);
    }
}
