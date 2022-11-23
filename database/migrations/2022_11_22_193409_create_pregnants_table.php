<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePregnantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnants', function (Blueprint $table) {
            $table->id();
            $table->string('lmp')->nullable();
            $table->string('edc')->nullable();
            $table->string('gp')->nullable();
            $table->string('wt')->nullable();
            $table->string('bp')->nullable();
            $table->foreignId('profile_id');
            $table->string('husband')->nullable();
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
        Schema::dropIfExists('pregnants');
    }
}
