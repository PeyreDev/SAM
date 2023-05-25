<?php

namespace Database\Seeders;

use App\Models\Substrate_batch;
use Illuminate\Database\Seeder;

class SubstrateBatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $substrate_batches = [
            [
                'id'                    => 1,
                'name'                  => 'SiC_undoped',
                'material'              => 15,
                'thickness'             => 350,
                'doping'                => 0,
                'doping_element'        => null,
                'doping_type'           => 0,
                'resistivity'           => 0,
                'provider'              => 'CREE',
                'orientation'           => 16,
                'miscut'                => 0.1,
                'remaining_quantity'    => 25,
                'initial_quantity'      => 50,
                'mapping'               => 'image/substrat01.jpeg',
                'comment'               => 'premier lot de substrat non dopé',
                'user_id'               => 1,
                'element_size'          => '10x10 and 5x5'
            ],
            [
                'id'                    => 2,
                'name'                  => 'SiC_doped',
                'material'              => 15,
                'thickness'             => 430,
                'doping'                => 0,
                'doping_element'        => 'P',
                'doping_type'           => 1,
                'resistivity'           => 0.1,
                'provider'              => 'CREE',
                'orientation'           => 17,
                'miscut'                => 0.3,
                'remaining_quantity'    => 12,
                'initial_quantity'      => 20,
                'mapping'               => 'image/substrat02.jpeg',
                'comment'               => 'premier lot de substrat dopé',
                'user_id'               => 1,
                'element_size'          => '5x5'
            ],
        ];

        Substrate_batch::insert($substrate_batches);
    }
}
