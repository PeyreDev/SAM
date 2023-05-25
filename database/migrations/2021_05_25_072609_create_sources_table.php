<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('supplier', 100);
            $table->string('reference', 100);
            $table->dateTime('manufacturing_date')->nullable();
            $table->string('purity', 50);
            $table->string('dilution', 50)->nullable();
            $table->string('quantity', 50);
            $table->integer('conditionning');
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
        Schema::dropIfExists('sources');
    }
}
