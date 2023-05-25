<?php

namespace Database\Seeders;

use App\Models\Substrate;
use Illuminate\Database\Seeder;

class SubstrateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $substrates = [
            [
                'id'                 => 1,
                'position'           => '22',
                'face'               => 'Si',
                'substrate_batch_id' => 1,
            ],
            [
                'id'                 => 2,
                'position'           => '12',
                'face'               => 'C',
                'substrate_batch_id' => 1,
            ],
            [
                'id'                 => 3,
                'position'           => '6',
                'face'               => 'Si',
                'substrate_batch_id' => 2,
            ],
        ];

        Substrate::insert($substrates);
    }
}
