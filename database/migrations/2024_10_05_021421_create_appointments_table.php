<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->date('date');
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->text('remarks')->nullable();
            $table->string('service')->nullable();
            $table->enum('status', ['Finished', 'For Approval', 'Approved', 'Rejected', 'Cancelled'])->default('For Approval');
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
        Schema::dropIfExists('appointments');
    }
}
