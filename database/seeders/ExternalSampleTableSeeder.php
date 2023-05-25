<?php

namespace Database\Seeders;

use App\Models\External_sample;
use Illuminate\Database\Seeder;

class ExternalSampleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $external_samples = [
            [
                'id'           => 1,
                'origin'       => 'collaborateur de Benoît',
            ],
        ];

        External_sample::insert($external_samples);
    }
}
