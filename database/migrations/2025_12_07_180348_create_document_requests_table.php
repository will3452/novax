<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("document_requests", function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("reference_number");
            $table->string("status")->default("pending");
            $table->integer("document_id");
            $table->integer("barangay_id");
            $table->text("purpose")->nullable();
            $table->string("fee")->default("0");
            $table->string("processing_period")->default("1");
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
        Schema::dropIfExists("document_requests");
    }
}
