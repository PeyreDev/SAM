<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasLineSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_line_source', function (Blueprint $table) {
            $table->foreignId('gas_line_id')->constrained('gas_lines');
            $table->foreignId('source_id')->constrained('sources');
            $table->dateTime('date_in');
            $table->dateTime('date_out')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gas_line_source');
    }
}
