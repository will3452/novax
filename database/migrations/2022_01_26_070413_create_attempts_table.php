<?php

use App\Models\Attempt;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->string('attemptable_type');
            $table->foreignId('attemptable_id')
                ->onDelete('cascade');
            $table->string('score')->nullable();
            $table->foreignId('user_id')
                ->onDelete('cascade');
            $table->string('number_of_items')->nullable();
            $table->string('status')
                ->default(Attempt::STATUS_NOT_YET);
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
        Schema::dropIfExists('attempts');
    }
}
