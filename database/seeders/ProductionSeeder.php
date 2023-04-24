<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Production;

class ProductionSeeder extends Seeder
{
    public function run()
    {
        $productions = [
            [
                'jenis_produksi' => 'Laminasi Glossy'
            ],
            [
                'jenis_produksi' => 'Laminasi Doff'
            ],
            [
                'jenis_produksi' => 'Foil'
            ]
        ];

        foreach ($productions as $production) {
            Production::create($production);
        }
    }
}