<?php

use App\Models\Booking;
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
            $table->integer('driver_id');
            $table->integer('passenger_id');
            $table->string('origin')->nullable();
            $table->string('from_coords')->nullable();
            $table->string('to_coords')->nullable();
            $table->string('destination')->nullable();
            $table->integer('number_of_passenger');
            $table->string('payable');
            $table->string('reference');
            $table->string('status')->default(Booking::STATUS_PENDING); 
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
