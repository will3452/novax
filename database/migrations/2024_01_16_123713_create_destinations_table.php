<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('lat');
            $table->string('lng');
            $table->text('description');
            $table->integer('category_id'); 
            $table->string('entry_fees')->default('0'); 
            $table->string('operating_hours');
            $table->string('best_time_to_visit'); 
            $table->json('nearby_accommodations');
            $table->json('transportation')->nullable();
            $table->string('accessibility')->nullable(); 
            $table->json('weather')->nullable(); 
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
        Schema::dropIfExists('destinations');
    }
}
