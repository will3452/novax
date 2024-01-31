<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_records', function (Blueprint $table) {
            $table->id();
            $table->integer('alumnus_id'); 
            $table->string('scope');
            $table->string('work_type');
            $table->boolean('is_private')->nullable(); 
            $table->string('company')->nullable();
            $table->string('company_address')->nullable(); 
            $table->boolean('is_aligned')->nullable(); 
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
        Schema::dropIfExists('professional_records');
    }
}
