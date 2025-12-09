<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangayEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("barangay_events", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->date("date");
            $table->string("time");
            $table->string("location");
            $table->integer("barangay_id");
            $table->integer("author_id");
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
        Schema::dropIfExists("barangay_events");
    }
}
