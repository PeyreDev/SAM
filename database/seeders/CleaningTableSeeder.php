<?php

namespace Database\Seeders;

use App\Models\Cleaning;
use Illuminate\Database\Seeder;

class CleaningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cleanings = [
            [
                'id'                    => 1,
                'description'           => 'nettoyage a l\'alcool',
            ],
            [
                'id'                    => 2,
                'description'           => 'nettoyage a l\'acetone',
            ],
        ];

        Cleaning::insert($cleanings);
    }
}
