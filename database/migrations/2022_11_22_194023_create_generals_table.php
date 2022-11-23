<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->string('temp')->nullable();
            $table->string('bp')->nullable();
            $table->string('hr')->nullable();
            $table->string('pr')->nullable();
            $table->string('o2_level')->nullable();
            $table->string('chief_complaint')->nullable();
            $table->string('treatment_management')->nullable();
            $table->foreignId('profile_id');
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
        Schema::dropIfExists('generals');
    }
}
