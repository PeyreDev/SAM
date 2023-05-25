<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipments = [
            [
                'id'             => 1,
                'supplier'       => 'AnnealSys',
                'model'          => 'Zenith 100',
                'serial'         => '125357458',
                'out_date'       => null,
                'equipment_type' => 6,
            ],
            [
                'id'             => 2,
                'supplier'       => 'AnnealSys',
                'model'          => 'Zenith 200',
                'serial'         => '8662357458',
                'out_date'       => null,
                'equipment_type' => 6,
            ],
            [
                'id'             => 3,
                'supplier'       => 'Aixtron',
                'model'          => 'OMR',
                'serial'         => '269715498',
                'out_date'       => new \DateTime(),
                'equipment_type' => 6,
            ],
            [
                'id'             => 4,
                'supplier'       => 'SuperHotte',
                'model'          => 'Laminaire',
                'serial'         => '285487515',
                'out_date'       => null,
                'equipment_type' => 7,
            ],
        ];

        Equipment::insert($equipments);
    }
}
