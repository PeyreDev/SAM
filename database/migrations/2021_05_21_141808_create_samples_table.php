<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('size', 200)->nullable();
            $table->string('parent_position', 200)->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('samples');
            $table->boolean('available')->default(true);
            $table->boolean('scraped')->default(false);
            $table->string('comment', 3000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('samples');
    }
}
