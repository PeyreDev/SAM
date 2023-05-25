<?php

namespace Database\Seeders;

use App\Models\Localisation;
use Illuminate\Database\Seeder;

class LocalisationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localisations = [
            [
                'id'                   => 1,
                'date_in'              => new \DateTime('2020-05-26 09:44:00'),
                'description'          => 'Salle du four, batiment 21 RDC',
                'related_type'         => 'App\Models\Equipment',
                'related_id'           => 1,
            ],
            [
                'id'                   => 2,
                'date_in'              => new \DateTime(),
                'description'          => 'Salle du four, batiment 13',
                'related_type'         => 'App\Models\Equipment',
                'related_id'           => 1,
            ],
            [
                'id'                   => 3,
                'date_in'              => new \DateTime(),
                'description'          => 'Chez AnnealSys',
                'related_type'         => 'App\Models\Equipment',
                'related_id'           => 2,
            ],
            [
                'id'                   => 4,
                'date_in'              => new \DateTime(),
                'description'          => 'Bureau de Perrine',
                'related_type'         => 'App\Models\Sample',
                'related_id'           => 1,
            ],
            [
                'id'                   => 5,
                'date_in'              => new \DateTime(),
                'description'          => 'Bureau de Perrine',
                'related_type'         => 'App\Models\Sample',
                'related_id'           => 2,
            ],
            [
                'id'                   => 6,
                'date_in'              => new \DateTime(),
                'description'          => 'Bureau de Perrine',
                'related_type'         => 'App\Models\Sample',
                'related_id'           => 3,
            ],
            [
                'id'                   => 7,
                'date_in'              => new \DateTime(),
                'description'          => 'Envoyé a Tonbouktou',
                'related_type'         => 'App\Models\Sample',
                'related_id'           => 4,
            ],
            [
                'id'                   => 8,
                'date_in'              => new \DateTime(),
                'description'          => 'Bureau de Benoit',
                'related_type'         => 'App\Models\Sample',
                'related_id'           => 5,
            ],
            [
                'id'                   => 9,
                'date_in'              => new \DateTime(),
                'description'          => 'Bureau de Perrine',
                'related_type'         => 'App\Models\Sample',
                'related_id'           => 6,
            ],
            [
                'id'                   => 10,
                'date_in'              => new \DateTime(),
                'description'          => 'Batiment 21 sous sol',
                'related_type'         => 'App\Models\Equipment',
                'related_id'           => 3,
            ],
        ];

        Localisation::insert($localisations);
    }
}
