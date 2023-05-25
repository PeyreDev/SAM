<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'id'                   => 1,
                'keyword'              => 'Graphène',
                'tagcat_id'            => 1,
            ],
            [
                'id'                   => 2,
                'keyword'              => 'GaN',
                'tagcat_id'            => 1,
            ],
            [
                'id'                   => 3,
                'keyword'              => 'Sublimation',
                'tagcat_id'            => 2,
            ],
            [
                'id'                   => 4,
                'keyword'              => 'CVD',
                'tagcat_id'            => 2,
            ],
            [
                'id'                   => 5,
                'keyword'              => 'MOCVD',
                'tagcat_id'            => 2,
            ],
            [
                'id'                   => 6,
                'keyword'              => 'CVD',
                'tagcat_id'            => 3,
            ],
            [
                'id'                   => 7,
                'keyword'              => 'Hotte',
                'tagcat_id'            => 3,
            ],
            [
                'id'                   => 8,
                'keyword'              => 'Détection synchrone',
                'tagcat_id'            => 3,
            ],
            [
                'id'                   => 9,
                'keyword'              => 'Image',
                'tagcat_id'            => 4,
            ],
            [
                'id'                   => 10,
                'keyword'              => 'PDF',
                'tagcat_id'            => 4,
            ],
            [
                'id'                   => 11,
                'keyword'              => 'Fichier historique',
                'tagcat_id'            => 4,
            ],
            [
                'id'                   => 12,
                'keyword'              => 'Single layer',
                'tagcat_id'            => 5,
            ],
            [
                'id'                   => 13,
                'keyword'              => 'Solar cell',
                'tagcat_id'            => 5,
            ],
            [
                'id'                   => 14,
                'keyword'              => 'Quantum well',
                'tagcat_id'            => 5,
            ],
            [
                'id'                   => 15,
                'keyword'              => 'SiC',
                'tagcat_id'            => 1,
            ],
            [
                'id'                   => 16,
                'keyword'              => '111',
                'tagcat_id'            => 6,
            ],
            [
                'id'                   => 17,
                'keyword'              => '100',
                'tagcat_id'            => 6,
            ],
            [
                'id'                   => 18,
                'keyword'              => '110',
                'tagcat_id'            => 6,
            ],
            [
                'id'                   => 19,
                'keyword'              => '11-22',
                'tagcat_id'            => 6,
            ],
            [
                'id'                   => 20,
                'keyword'              => '11-20',
                'tagcat_id'            => 6,
            ],
            [
                'id'                   => 21,
                'keyword'              => '0001',
                'tagcat_id'            => 6,
            ],
            [
                'id'                   => 22,
                'keyword'              => 'C plane',
                'tagcat_id'            => 6,
            ],
            [
                'id'                   => 23,
                'keyword'              => 'M plane',
                'tagcat_id'            => 6,
            ],
            [
                'id'                   => 24,
                'keyword'              => 'R plane',
                'tagcat_id'            => 6,
            ],
            [
                'id'                   => 25,
                'keyword'              => 'A plane',
                'tagcat_id'            => 6,
            ],
        ];

        Tag::insert($tags);
    }
}
