<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpfulCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpful_counts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guide_id'); // Foreign key to guides table
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            // Foreign keys
            $table->foreign('guide_id')->references('id')->on('guides')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('helpful_counts');
    }
}
