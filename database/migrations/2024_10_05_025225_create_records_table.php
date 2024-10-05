<?php

use App\Models\User;
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
            $table->foreignIdFor(User::class, 'patient_id');
            $table->string('condition');
            $table->date('diagnosis_date')->nullable();
            $table->text('allergies')->nullable();
            $table->text('family_history')->nullable();
            $table->text('prev_hospitalization')->nullable();
            $table->string('doctor')->nullable();
            $table->date('last_visit_date')->nullable();
            $table->text('notes')->nullable();
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
