<?php

namespace Database\Seeders;

use App\Models\Process_step;
use Illuminate\Database\Seeder;

class ProcessStepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sample_steps = [
            [
                'id'                    => 1,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\Substrate',
                'related_id'            => 1,
                'user_id'               => 1,
            ],
            [
                'id'                    => 2,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\Cvr',
                'related_id'            => 1,
                'user_id'               => 1,
            ],
            [
                'id'                    => 3,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\Substrate',
                'related_id'            => 2,
                'user_id'               => 2,
            ],
            [
                'id'                    => 4,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\Cvr',
                'related_id'            => 2,
                'user_id'               => 2,
            ],
            [
                'id'                    => 5,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\Split',
                'related_id'            => 1,
                'user_id'               => 2,
            ],
            [
                'id'                    => 6,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\External_sample',
                'related_id'            => 1,
                'user_id'               => 1,
            ],
            [
                'id'                    => 7,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\Substrate',
                'related_id'            => 3,
                'user_id'               => 2,
            ],
            [
                'id'                    => 8,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\Cvr',
                'related_id'            => 3,
                'user_id'               => 2,
            ],
            [
                'id'                    => 9,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\Cleaning',
                'related_id'            => 1,
                'user_id'               => 1,
            ],
            [
                'id'                    => 10,
                'date'                  => new \DateTime(),
                'related_type'          => 'App\Models\Cleaning',
                'related_id'            => 2,
                'user_id'               => 2,
            ],
        ];

        Process_step::insert($sample_steps);
    }
}
