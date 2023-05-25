<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_lines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('install_date');
            $table->dateTime('remove_date')->nullable();
            $table->double('max_inject');
            $table->double('max_source')->nullable();
            $table->double('max_dilute')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gas_lines');
    }
}
