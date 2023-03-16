<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_visit')->nullable();
            $table->longText('diagnosis')->nullable();
            $table->longText('treatment_plan')->nullable();
            $table->longText('medications')->nullable();
            $table->longText('test_results')->nullable();
            $table->longText('progress_notes')->nullable();
            $table->longText('follow_up_instructions')->nullable();
            $table->longText('discharge_summary')->nullable();
            $table->longText('allergies')->nullable();
            $table->longText('family_history')->nullable();
            $table->longText('social_history')->nullable();
            $table->foreignId('user_id');
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
        Schema::dropIfExists('records');
    }
}
