<?php

namespace Database\Seeders;

use App\Models\Tagcat;
use Illuminate\Database\Seeder;

class TagCatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCats = [
            [
                'id'                => 1,
                'keyword'           => 'Material',
            ],
            [
                'id'                => 2,
                'keyword'           => 'Process type',
            ],
            [
                'id'                => 3,
                'keyword'           => 'Equipment type',
            ],
            [
                'id'                => 4,
                'keyword'           => 'Document type',
            ],
            [
                'id'                => 5,
                'keyword'           => 'Sample type',
            ],
            [
                'id'                => 6,
                'keyword'           => 'Orientation',
            ],
        ];

        Tagcat::insert($tagCats);
    }
}
