<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_flows', function (Blueprint $table) {
            $table->id();
            $table->double('inject_final_value')->nullable();
            $table->double('MO_pressure')->nullable();
            $table->double('MO_temperature')->nullable();
            $table->double('dilute_value')->nullable();
            $table->double('source_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_flows');
    }
}
