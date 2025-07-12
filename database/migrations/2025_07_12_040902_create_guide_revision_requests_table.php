<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuideRevisionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_revision_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User requesting the revision
            $table->unsignedBigInteger('guide_id'); // Guide being requested for revision
            $table->text('reason'); // Reason for the revision request
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING'); // Status of the request

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('guide_revision_requests');
    }
}
