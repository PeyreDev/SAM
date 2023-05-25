<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentGasLineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::find(1)->gasLines()->attach(1);
        Equipment::find(1)->gasLines()->attach(2);
        Equipment::find(1)->gasLines()->attach(3);
        Equipment::find(1)->gasLines()->attach(4);
        Equipment::find(2)->gasLines()->attach(1);
        Equipment::find(2)->gasLines()->attach(2);
    }
}
