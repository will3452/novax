<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDentalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dental_records', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('gingivitis')->default(false);
            $table->boolean('early')->default(false);
            $table->boolean('moderate')->default(false);
            $table->boolean('advance')->default(false);
            $table->boolean('class')->default(false);
            $table->boolean('overjet')->default(false);
            $table->boolean('overbite')->default(false);
            $table->boolean('midline')->default(false);
            $table->boolean('crossbite')->default(false);
            $table->boolean('ortho')->default(false);
            $table->boolean('stay')->default(false);
            $table->string('others')->nullable();
            $table->boolean('clenching')->default(false);
            $table->boolean('clicking')->default(false);
            $table->boolean('tris')->default(false);
            $table->boolean('muscle')->default(false);
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
        Schema::dropIfExists('dental_records');
    }
}
