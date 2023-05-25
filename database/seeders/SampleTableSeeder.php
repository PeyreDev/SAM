<?php

namespace Database\Seeders;

use App\Models\Sample;
use Illuminate\Database\Seeder;

class SampleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $samples = [
            [
                'id'                => 1,
                'name'              => 's100',
                'size'              => '5x5',
                'parent_position'   => null,
                'parent_id'         => null,
                'available'         => true,
                'scraped'           => false,
                'comment'           => '1er échantillon',
            ],
            [
                'id'                => 2,
                'name'              => 's200',
                'size'              => '10x10',
                'parent_position'   => null,
                'parent_id'         => null,
                'available'         => false,
                'scraped'           => false,
                'comment'           => 'échantillon splité',
            ],
            [
                'id'                => 3,
                'name'              => 's200A',
                'size'              => '5x10',
                'parent_position'   => 'gauche',
                'parent_id'         => 2,
                'available'         => true,
                'scraped'           => false,
                'comment'           => 'morceau gauche du s200',
            ],
            [
                'id'                => 4,
                'name'              => 's200B',
                'size'              => '5x10',
                'parent_position'   => 'droite',
                'parent_id'         => 2,
                'available'         => true,
                'scraped'           => false,
                'comment'           => 'morceau droit du s200',
            ],
            [
                'id'                => 5,
                'name'              => 'ex001',
                'size'              => '15x10',
                'parent_position'   => null,
                'parent_id'         => null,
                'available'         => true,
                'scraped'           => false,
                'comment'           => 'echantillon externe',
            ],
            [
                'id'                => 6,
                'name'              => 'cvd001',
                'size'              => '20x10',
                'parent_position'   => null,
                'parent_id'         => null,
                'available'         => true,
                'scraped'           => false,
                'comment'           => '1er échantillon CVD',
            ],
        ];

        Sample::insert($samples);
    }
}
