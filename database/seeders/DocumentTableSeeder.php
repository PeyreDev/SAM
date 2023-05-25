<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documents = [
            [
                'id'                 => 1,
                'name'               => 'Analyse certificate',
                'path'               => 'certificate/Analyse.pdf',
                'related_type'       => 'App\Models\Substrate_batch',
                'related_id'         => 1,
            ],
            [
                'id'                 => 2,
                'name'               => 'Notice equipment',
                'path'               => 'Equipment/Notice.pdf',
                'related_type'       => 'App\Models\Equipment',
                'related_id'         => 2,
            ],
            [
                'id'                 => 3,
                'name'               => 'Equipment Pic',
                'path'               => 'image/photo.jpg',
                'related_type'       => 'App\Models\Equipment',
                'related_id'         => 2,
            ],
            [
                'id'                 => 4,
                'name'               => 'Sample pic',
                'path'               => 'image/extSample01.jpeg',
                'related_type'       => 'App\Models\External_sample',
                'related_id'         => 1,
            ],
            [
                'id'                 => 5,
                'name'               => 'Facture transporteur',
                'path'               => 'factures/transportSpl4.pdf',
                'related_type'       => 'App\Models\Sample',
                'related_id'         => 4,
            ],
            [
                'id'                 => 6,
                'name'               => 'Analyse certificate',
                'path'               => 'certificate/AnalyseSource.pdf',
                'related_type'       => 'App\Models\Source',
                'related_id'         => 4,
            ],
        ];

        Document::insert($documents);
    }
}
