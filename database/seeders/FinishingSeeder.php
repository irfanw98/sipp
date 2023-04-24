<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Finishing;

class FinishingSeeder extends Seeder
{
    public function run()
    {
        $finishings = [
            [
                'jenis_finishing' => 'Paket'
            ],
            [
                'jenis_finishing' => 'Biasa'
            ]
        ];

        foreach ($finishings as $finishing) {
            Finishing::create($finishing);
        }
    }
}
