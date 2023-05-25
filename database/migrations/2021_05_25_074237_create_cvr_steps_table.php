<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvrStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvr_steps', function (Blueprint $table) {
            $table->id();
            $table->double('pressure');
            $table->time('duration');
            $table->double('temperature_initial');
            $table->double('temperature_final')->nullable();
            $table->foreignId('cvr_id')->constrained('cvrs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cvr_steps');
    }
}
