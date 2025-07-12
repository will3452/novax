<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuideVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_versions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guide_id');
            $table->string('version');
            $table->text('content');
            $table->string('status')->default('DRAFT'); // DRAFT, PUBLISHED, ARCHIVED

            // Foreign key
            $table->foreign('guide_id')->references('id')->on('guides')->onDelete('cascade');

            // Timestamps
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
        Schema::dropIfExists('guide_versions');
    }
}
