<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubstratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('substrates', function (Blueprint $table) {
            $table->id();
            $table->string('position', 200);
            $table->string('face', 20)->nullable();
            $table->foreignId('substrate_batch_id')->constrained('substrate_batches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('substrates');
    }
}
