<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentProcessStepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::find(1)->processSteps()->attach(2);
        Equipment::find(1)->processSteps()->attach(4);
        Equipment::find(2)->processSteps()->attach(8);
        Equipment::find(4)->processSteps()->attach(9);
        Equipment::find(4)->processSteps()->attach(10);
    }
}
