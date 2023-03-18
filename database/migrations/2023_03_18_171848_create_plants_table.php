<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('common_name');
            $table->string('scientific_name')->nullable();
            $table->string('habitat')->nullable();
            $table->string('family')->nullable();
            $table->text('description')->nullable();
            $table->text('tips')->nullable();
            $table->string('air')->nullable();
            $table->string('light')->nullable();
            $table->string('temp')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plants');
    }
}
