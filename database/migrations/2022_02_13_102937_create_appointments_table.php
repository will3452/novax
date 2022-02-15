<?php

use App\Models\Appointment;
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
            $table->foreignId('patient_id')
                ->onDelete('cascade');
            $table->foreignId('doctor_id')
                ->onDelete('set null')
                ->nullable();
            $table->timestamp('datetime')
                ->nullable();
            $table->timestamp('approved_at')
                ->nullable();
            $table->string('status')
                ->default(Appointment::STATUS_PENDING);
            $table->text('notes')
                ->nullable();
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
