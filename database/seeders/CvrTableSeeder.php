<?php

namespace Database\Seeders;

use App\Models\Cvr;
use Illuminate\Database\Seeder;

class CvrTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cvrs = [
            [
                'id'                => 1,
                'recipe_name'       => 's100 process',
                'motivation'        => 'faire une première sublimation',
                'comment'           => null,
                'position'          => 'position A',
                'equipment_id'      => 1,
            ],
            [
                'id'                => 2,
                'recipe_name'       => 's100 process avec rampe température',
                'motivation'        => 'faire une rampe',
                'comment'           => null,
                'position'          => 'position B',
                'equipment_id'      => 1,
            ],
            [
                'id'                => 3,
                'recipe_name'       => 'CVD process',
                'motivation'        => 'faire un process CVD',
                'comment'           => null,
                'position'          => 'position A',
                'equipment_id'      => 1,
            ],
        ];

        Cvr::insert($cvrs);
    }
}
