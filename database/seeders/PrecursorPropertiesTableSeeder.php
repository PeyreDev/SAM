<?php

namespace Database\Seeders;

use App\Models\Precursor_properties;
use Illuminate\Database\Seeder;

class PrecursorPropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $precursor_properties = [
            [
                'id'                => 1,
                'species'           => 'H2',
                'A'                 => null,
                'B'                 => null,
                'C'                 => null,
                'Tfusion'           => null,
                'Tliquid'           => null,
            ],
            [
                'id'                => 2,
                'species'           => 'Ar',
                'A'                 => null,
                'B'                 => null,
                'C'                 => null,
                'Tfusion'           => null,
                'Tliquid'           => null,
            ],
            [
                'id'                => 3,
                'species'           => 'CH4',
                'A'                 => null,
                'B'                 => null,
                'C'                 => null,
                'Tfusion'           => null,
                'Tliquid'           => null,
            ],
            [
                'id'                => 4,
                'species'           => 'C3H8',
                'A'                 => null,
                'B'                 => null,
                'C'                 => null,
                'Tfusion'           => null,
                'Tliquid'           => null,
            ],
        ];

        Precursor_properties::insert($precursor_properties);
    }
}
