<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')
                ->onDelete('cascade');
            $table->string('code')->nullable();
            $table->string('strand')->nullable();
            $table->string('level')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_manual_checking')->default(0);
            $table->string('time_limit')->nullable();
            $table->timestamp('opened_at')->nullable();
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
        Schema::dropIfExists('exams');
    }
}
