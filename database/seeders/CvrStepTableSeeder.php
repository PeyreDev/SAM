<?php

namespace Database\Seeders;

use App\Models\Cvr_step;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Type\Time;

class CvrStepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cvr_steps = [
            [
                'id'                        => 1,
                'pressure'                  => 1000,
                'duration'                  => new Time(1800),
                'temperature_initial'       => 1200,
                'temperature_final'         => null,
                'cvr_id'                    => 1,
            ],
            [
                'id'                        => 2,
                'pressure'                  => 1010,
                'duration'                  => new Time(2100),
                'temperature_initial'       => 1200,
                'temperature_final'         => null,
                'cvr_id'                    => 2,
            ],
            [
                'id'                        => 3,
                'pressure'                  => 1020,
                'duration'                  => new Time(1500),
                'temperature_initial'       => 1200,
                'temperature_final'         => 1600,
                'cvr_id'                    => 2,
            ],
            [
                'id'                        => 4,
                'pressure'                  => 900,
                'duration'                  => new Time(1200),
                'temperature_initial'       => 1200,
                'temperature_final'         => null,
                'cvr_id'                    => 3,
            ],
            [
                'id'                        => 5,
                'pressure'                  => 950,
                'duration'                  => new Time(1500),
                'temperature_initial'       => 1300,
                'temperature_final'         => null,
                'cvr_id'                    => 3,
            ],
            [
                'id'                        => 6,
                'pressure'                  => 950,
                'duration'                  => new Time(1200),
                'temperature_initial'       => 1300,
                'temperature_final'         => 1700,
                'cvr_id'                    => 3,
            ],
        ];

        Cvr_step::insert($cvr_steps);
    }
}
