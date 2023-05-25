<?php

namespace Database\Seeders;

use App\Models\Split;
use Illuminate\Database\Seeder;

class SplitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $splits = [
            [
                'id'                => 1,
                'mapping'           => 'images/split1.jpeg',
                'comment'           => 'Premier split sur sample ex001',
            ],
        ];

        Split::insert($splits);
    }
}
