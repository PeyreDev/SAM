<?php

namespace Database\Seeders;

use App\Models\Gas_line;
use Illuminate\Database\Seeder;

class GasLineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gas_lines = [
            [
                'id'                      => 1,
                'name'                    => 'gas line 1',
                'install_date'            => new \DateTime(),
                'remove_date'             => null,
                'max_inject'              => 1000,
                'max_source'              => null,
                'max_dilute'              => null,
            ],
            [
                'id'                      => 2,
                'name'                    => 'gas line 2',
                'install_date'            => new \DateTime(),
                'remove_date'             => null,
                'max_inject'              => 2000,
                'max_source'              => null,
                'max_dilute'              => null,
            ],
            [
                'id'                      => 3,
                'name'                    => 'gas line 3',
                'install_date'            => new \DateTime(),
                'remove_date'             => null,
                'max_inject'              => 500,
                'max_source'              => null,
                'max_dilute'              => null,
            ],
            [
                'id'                      => 4,
                'name'                    => 'gas line 4',
                'install_date'            => new \DateTime('2020-05-25 12:12:52'),
                'remove_date'             => new \DateTime(),
                'max_inject'              => 1000,
                'max_source'              => null,
                'max_dilute'              => null,
            ],
        ];

        Gas_line::insert($gas_lines);
    }
}
