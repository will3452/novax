<?php

use App\Models\SectionStudent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_students', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default(SectionStudent::STATUS_PENDING); 
            $table->integer('student_id');
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
        Schema::dropIfExists('section_students');
    }
}
