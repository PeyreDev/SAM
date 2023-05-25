<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvrs', function (Blueprint $table) {
            $table->id();
            $table->string('recipe_name', 200)->nullable();
            $table->string('motivation', 3000)->nullable();
            $table->string('comment', 3000)->nullable();
            $table->string('position', 200)->nullable();
            $table->foreignId('equipment_id')->constrained('equipments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cvrs');
    }
}
