<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecursorPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precursor_properties', function (Blueprint $table) {
            $table->id();
            $table->string('species', 100);
            $table->double('A')->nullable();
            $table->double('B')->nullable();
            $table->double('C')->nullable();
            $table->double('Tfusion')->nullable();
            $table->double('Tliquid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precursor_properties');
    }
}
