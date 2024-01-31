<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnus', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(); 
            $table->string('first_name'); 
            $table->string('last_name'); 
            $table->string('middle_name')->nullable();
            $table->string('gender')->string('Male');
            $table->string('batch');
            $table->string('birthday');
            $table->string('program');
            $table->string('employment_status')->default('Unemployed'); 
            $table->string('soc_med'); 
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
        Schema::dropIfExists('alumnus');
    }
}
