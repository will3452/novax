<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_problems', function (Blueprint $table) {
            $table->id();
            $table->string('HPN');
            $table->string('CVD');
            $table->string('cancer');
            $table->string('renal');
            $table->string('diabetes');
            $table->string('TB');
            $table->string('goiter');
            $table->string('others')->nullable();
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
        Schema::dropIfExists('health_problems');
    }
}
