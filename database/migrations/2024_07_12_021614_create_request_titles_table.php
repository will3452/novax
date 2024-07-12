<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description'); 
            $table->string('file')->nullable(); 
            $table->integer('no_of_students')->default(1);
            $table->string('ic_type');
            $table->string('status')->default('PENDING');
            $table->integer('section_id'); 
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
        Schema::dropIfExists('request_titles');
    }
}
