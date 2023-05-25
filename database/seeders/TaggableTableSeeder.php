<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaggableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taggables')->insert(array(
            array('taggable_type' => 'App\Models\Sample', 'taggable_id' => 1, 'tag_id' => 12),
            array('taggable_type' => 'App\Models\Sample', 'taggable_id' => 2, 'tag_id' => 12),
            array('taggable_type' => 'App\Models\Sample', 'taggable_id' => 3, 'tag_id' => 12),
            array('taggable_type' => 'App\Models\Sample', 'taggable_id' => 4, 'tag_id' => 12),
            array('taggable_type' => 'App\Models\Sample', 'taggable_id' => 5, 'tag_id' => 14),
            array('taggable_type' => 'App\Models\Sample', 'taggable_id' => 6, 'tag_id' => 12),
            array('taggable_type' => 'App\Models\Cvr', 'taggable_id' => 1, 'tag_id' => 4),
            array('taggable_type' => 'App\Models\Cvr', 'taggable_id' => 2, 'tag_id' => 4),
            array('taggable_type' => 'App\Models\Cvr', 'taggable_id' => 3, 'tag_id' => 4),
            array('taggable_type' => 'App\Models\Cvr_step', 'taggable_id' => 1, 'tag_id' => 1),
            array('taggable_type' => 'App\Models\Cvr_step', 'taggable_id' => 2, 'tag_id' => 1),
            array('taggable_type' => 'App\Models\Cvr_step', 'taggable_id' => 4, 'tag_id' => 1),
            array('taggable_type' => 'App\Models\Cvr_step', 'taggable_id' => 5, 'tag_id' => 1),
            array('taggable_type' => 'App\Models\External_sample', 'taggable_id' => 1, 'tag_id' => 1),
            array('taggable_type' => 'App\Models\Sample', 'taggable_id' => 6, 'tag_id' => 13),
            array('taggable_type' => 'App\Models\External_sample', 'taggable_id' => 1, 'tag_id' => 2),
            array('taggable_type' => 'App\Models\External_sample', 'taggable_id' => 1, 'tag_id' => 14),
        ));
    }
}
