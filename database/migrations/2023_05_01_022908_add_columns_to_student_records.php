<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStudentRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_records', function (Blueprint $table) {
            $table->string('prelim_grade')->nullable();
            $table->string('midterm_grade')->nullable();
            $table->string('pre_final_grade')->nullable();
            $table->string('total_grade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_records', function (Blueprint $table) {
            $table->dropColumn(['prelim_grade', 'midterm_grade', 'pre_final_grade']);
        });
    }
}
