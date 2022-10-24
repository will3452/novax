<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('age')->nullable();
        $table->string('birthday')->nullable();
        $table->string('address')->nullable();
        $table->string('phone')->nullable();
        $table->string('food')->nullable();
        $table->string('color')->nullable();
        $table->string('hobby')->nullable();
        $table->string('movie')->nullable();
        $table->string('music')->nullable();
        $table->string('elementary')->nullable();
        $table->string('highscool')->nullable();
        $table->string('college')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

        });
    }
}
