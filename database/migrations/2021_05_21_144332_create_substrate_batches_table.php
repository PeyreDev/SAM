<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubstrateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('substrate_batches', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('material')->constrained('tags');
            $table->smallInteger('thickness', false, true)->nullable();
            $table->double('doping')->nullable();
            $table->string('doping_element', 20)->nullable();
            $table->tinyInteger('doping_type')->nullable();
            $table->double('resistivity')->nullable();
            $table->string('provider', 100)->nullable();
            $table->foreignId('orientation')->constrained('tags');
            $table->double('miscut')->nullable();
            $table->tinyInteger('remaining_quantity', false, true)->nullable();
            $table->tinyInteger('initial_quantity', false, true);
            $table->string('mapping', 1000)->nullable();
            $table->string('comment', 3000)->nullable();
            $table->foreignId('user_id');
            $table->string('element_size', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('substrate_batches');
    }
}
