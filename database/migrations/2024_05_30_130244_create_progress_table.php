<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id');
            $table->integer('group_id');
            $table->integer('week');
            $table->date('from_date');
            $table->date('to_date');
            $table->boolean('is_ready_for_oral_def')->nullable();
            $table->string('endorsed_by')->nullable();
            $table->longText('description')->nullable();
            $table->date('preferred_schedule')->nullable(); 
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
        Schema::dropIfExists('progress');
    }
}
