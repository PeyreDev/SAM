<?php

namespace Database\Seeders;

use App\Models\Sample;
use Illuminate\Database\Seeder;

class ProcessStepSampleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sample::find(1)->processSteps()->attach(1);
        Sample::find(1)->processSteps()->attach(2);
        Sample::find(2)->processSteps()->attach(3);
        Sample::find(2)->processSteps()->attach(4);
        Sample::find(2)->processSteps()->attach(5);
        Sample::find(5)->processSteps()->attach(6);
        Sample::find(6)->processSteps()->attach(7);
        Sample::find(6)->processSteps()->attach(8);
    }
}
