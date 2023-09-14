<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('server_id');
            $table->double('amount');
            $table->string('from_address');
            $table->string('from_lat');
            $table->string('from_lng');
            $table->string('to_address');
            $table->string('to_lat');
            $table->string('to_lng');
            $table->string('landmark');
            $table->string('mop')->default('CASH');
            $table->string('status')->default('AVAILABLE');
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
        Schema::dropIfExists('bookings');
    }
}
