<?php

namespace Database\Seeders;

use App\Models\Gas_line;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GasLineSourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gas_line_source')->insert(array(
            array('gas_line_id' => 1, 'source_id' => 1, 'date_in' => new \DateTime(), 'date_out' => null),
            array('gas_line_id' => 2, 'source_id' => 2, 'date_in' => new \DateTime(), 'date_out' => null),
            array('gas_line_id' => 3, 'source_id' => 3, 'date_in' => new \DateTime(), 'date_out' => null),
            array('gas_line_id' => 4, 'source_id' => 4, 'date_in' => new \DateTime(), 'date_out' => null),
            array('gas_line_id' => 1, 'source_id' => 5, 'date_in' => new \DateTime('2020-05-27 07:52:24'), 'date_out' => new \DateTime()),
        ));
    }
}
