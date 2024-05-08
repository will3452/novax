<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->string('section');
            $table->string('term');
            $table->string('school_year');
            $table->integer('no_of_students');
            $table->string('thesis_phase');
            $table->string('ic_type');
            $table->integer('creator_id');
            $table->string('pass_code'); 
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
        Schema::dropIfExists('sections');
    }
}
