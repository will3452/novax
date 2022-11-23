<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyHouseholdProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_household_profiles', function (Blueprint $table) {
            $table->id();
            $table->boolean('four_ps');
            $table->boolean('nhts');
            $table->string('purok');
            $table->string('dialect');
            $table->string('type_of_dwelling')->nullable();
            $table->string('type_of_electricity')->nullable();
            $table->string('source_of_water')->nullable();
            $table->string('sanitation_facilities')->nullable();
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
        Schema::dropIfExists('family_household_profiles');
    }
}
