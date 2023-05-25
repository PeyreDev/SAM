<?php

namespace Database\Seeders;

use App\Models\Special_flow;
use Illuminate\Database\Seeder;

class SpecialFlowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $special_flows = [
            [
                'id'                         => 1,
                'inject_final_value'         => 400,
                'MO_pressure'                => null,
                'MO_temperature'             => null,
                'dilute_value'               => null,
                'source_value'               => null,
            ],
        ];

        Special_flow::insert($special_flows);
    }
}
