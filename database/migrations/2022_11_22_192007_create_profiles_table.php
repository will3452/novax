<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('purok');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('sex');
            $table->string('middle_name')->nullable();
            $table->boolean('smoker');
            $table->boolean('alcohol_drinker');
            $table->boolean('hypertension');
            $table->boolean('diabetes');
            $table->boolean('pwd');
            $table->string('phic_membership')->nullable();
            $table->dateTime('birthdate')->nullable();
            $table->string('religion')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('education_attainment')->nullable();
            $table->string('occupation')->nullable();
            $table->string('cpno')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
