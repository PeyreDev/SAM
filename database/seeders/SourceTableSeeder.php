<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Seeder;

class SourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sources = [
            [
                'id'                         => 1,
                'supplier'                   => 'Air Liquide',
                'reference'                  => '5451155623',
                'manufacturing_date'         => new \DateTime(),
                'purity'                     => 'N60',
                'dilution'                   => null,
                'quantity'                   => '10m3',
                'conditionning'              => 4,
                'precursor_properties_id'    => 1,
            ],
            [
                'id'                         => 2,
                'supplier'                   => 'Prodair',
                'reference'                  => '65952584',
                'manufacturing_date'         => new \DateTime(),
                'purity'                     => 'N55',
                'dilution'                   => null,
                'quantity'                   => '4m3',
                'conditionning'              => 3,
                'precursor_properties_id'    => 2,
            ],
            [
                'id'                         => 3,
                'supplier'                   => 'Prodair',
                'reference'                  => '217845549',
                'manufacturing_date'         => new \DateTime(),
                'purity'                     => 'N50',
                'dilution'                   => null,
                'quantity'                   => '10m3',
                'conditionning'              => 4,
                'precursor_properties_id'    => 3,
            ],
            [
                'id'                         => 4,
                'supplier'                   => 'Air Liquide',
                'reference'                  => '8956318',
                'manufacturing_date'         => new \DateTime(),
                'purity'                     => 'N60',
                'dilution'                   => null,
                'quantity'                   => '1m3',
                'conditionning'              => 1,
                'precursor_properties_id'    => 4,
            ],
            [
                'id'                         => 5,
                'supplier'                   => 'Air Liquide',
                'reference'                  => '548763147',
                'manufacturing_date'         => new \DateTime(),
                'purity'                     => 'N60',
                'dilution'                   => null,
                'quantity'                   => '10m3',
                'conditionning'              => 4,
                'precursor_properties_id'    => 1,
            ],
        ];

        Source::insert($sources);
    }
}
