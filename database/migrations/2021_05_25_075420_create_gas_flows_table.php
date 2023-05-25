<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_flows', function (Blueprint $table) {
            $table->id();
            $table->float('inject_initial_value');
            $table->foreignId('cvr_step_id')->constrained('cvr_steps');
            $table->foreignId('source_id')->constrained('sources');
            $table->foreignId('gas_line_id')->constrained('gas_lines');
            $table->foreignId('special_flow_id')->nullable()->constrained('special_flows');
            $table->foreignId('precursor_properties_id')->constrained('precursor_properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gas_flows');
    }
}
