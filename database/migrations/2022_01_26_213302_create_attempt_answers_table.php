<?php

use App\Models\AttemptAnswer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempt_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')
                ->onDelete('cascade');
            $table->foreignId('answer_id')
                ->nullable()
                ->onDelete('set null');
            $table->foreignId('question_id')
                ->nullable()
                ->onDelete('set null');
            $table->string('type')
                ->default(AttemptAnswer::TYPE_WRONG);
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
        Schema::dropIfExists('attempt_answers');
    }
}
