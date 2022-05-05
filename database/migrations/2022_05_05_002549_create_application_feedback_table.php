<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_feedback', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->foreignId('employer_id')
                ->references('id')->on('users')
                ->constrained()->onDelete('cascade');
            $table->foreignId('application_id')
                ->references('id')->on('job_applications')
                ->constrained()->onDelete('cascade');
            $table->foreignId('applicant_id')
                ->references('id')->on('users')
                ->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('application_feedback');
    }
}
