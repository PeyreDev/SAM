<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use Illuminate\Database\Seeder;

class MaintenanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maintenances = [
            [
                'id'                   => 1,
                'date'                 => new \DateTime('2020-05-26 09:43:59'),
                'description'          => 'Nettoyage du four',
                'gravity'              => 1,
                'equipment_id'         => 1,
            ],
            [
                'id'                   => 2,
                'date'                 => new \DateTime(),
                'description'          => 'Recalibration du MFC H2',
                'gravity'              => 1,
                'equipment_id'         => 2,
            ],
            [
                'id'                   => 3,
                'date'                 => new \DateTime(),
                'description'          => 'Démontage remontage pour déménagement',
                'gravity'              => 2,
                'equipment_id'         => 3,
            ],
            [
                'id'                   => 4,
                'date'                 => new \DateTime(),
                'description'          => 'Remplacement de la pompe',
                'gravity'              => 1,
                'equipment_id'         => 1,
            ],
        ];

        Maintenance::insert($maintenances);
    }
}
