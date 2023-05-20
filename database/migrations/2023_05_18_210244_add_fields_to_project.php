<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('classification_id')->nullable();
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->integer('classification_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project', function (Blueprint $table) {
            $table->dropColumn('classification_id');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('classification_id');
        });
    }
}
