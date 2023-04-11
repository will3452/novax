<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveGradeSystemIdToTeachingLoads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teaching_loads', function (Blueprint $table) {
            $table->dropColumn(['grade_system_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teaching_loads', function (Blueprint $table) {
            $table->integer('grade_system_id');
        });
    }
}
