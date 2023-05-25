<?php

namespace Database\Seeders;

use App\Models\Gas_flow;
use Illuminate\Database\Seeder;

class GasFlowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gas_flows = [
            [
                'id'                             => 1,
                'inject_initial_value'           => 750,
                'cvr_step_id'                    => 1,
                'source_id'                      => 2,
                'gas_line_id'                    => 2,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 2,
            ],
            [
                'id'                             => 2,
                'inject_initial_value'           => 50,
                'cvr_step_id'                    => 1,
                'source_id'                      => 1,
                'gas_line_id'                    => 1,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 1,
            ],
            [
                'id'                             => 3,
                'inject_initial_value'           => 600,
                'cvr_step_id'                    => 2,
                'source_id'                      => 2,
                'gas_line_id'                    => 2,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 2,
            ],
            [
                'id'                             => 4,
                'inject_initial_value'           => 200,
                'cvr_step_id'                    => 2,
                'source_id'                      => 1,
                'gas_line_id'                    => 1,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 1,
            ],
            [
                'id'                             => 5,
                'inject_initial_value'           => 500,
                'cvr_step_id'                    => 4,
                'source_id'                      => 2,
                'gas_line_id'                    => 2,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 2,
            ],
            [
                'id'                             => 6,
                'inject_initial_value'           => 300,
                'cvr_step_id'                    => 4,
                'source_id'                      => 1,
                'gas_line_id'                    => 1,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 1,
            ],
            [
                'id'                             => 7,
                'inject_initial_value'           => 50,
                'cvr_step_id'                    => 4,
                'source_id'                      => 3,
                'gas_line_id'                    => 3,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 3,
            ],
            [
                'id'                             => 8,
                'inject_initial_value'           => 500,
                'cvr_step_id'                    => 5,
                'source_id'                      => 2,
                'gas_line_id'                    => 2,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 2,
            ],
            [
                'id'                             => 9,
                'inject_initial_value'           => 300,
                'cvr_step_id'                    => 5,
                'source_id'                      => 1,
                'gas_line_id'                    => 1,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 1,
            ],
            [
                'id'                             => 10,
                'inject_initial_value'           => 40,
                'cvr_step_id'                    => 5,
                'source_id'                      => 4,
                'gas_line_id'                    => 4,
                'special_flow_id'                => 1,
                'precursor_properties_id'        => 4,
            ],
            [
                'id'                             => 11,
                'inject_initial_value'           => 800,
                'cvr_step_id'                    => 6,
                'source_id'                      => 2,
                'gas_line_id'                    => 2,
                'special_flow_id'                => null,
                'precursor_properties_id'        => 2,
            ],
        ];

        Gas_flow::insert($gas_flows);
    }
}
