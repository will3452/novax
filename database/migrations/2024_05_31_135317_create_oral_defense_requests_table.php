<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOralDefenseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oral_defense_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable();
            $table->integer('group_id');
            $table->string('time');
            $table->string('date');
            $table->string('status');
            $table->string('venue');
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
        Schema::dropIfExists('oral_defense_requests');
    }
}
