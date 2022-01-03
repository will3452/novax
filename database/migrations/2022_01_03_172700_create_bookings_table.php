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

            $table->foreignId('user_id')->nullable();

            $table->foreignId('approver_id')->nullable();

            $table->foreignId('room_id')
                ->nullable()
                ->onDelete('set null');

            $table->string('reference_number');

            $table->timestamp('arrival');

            $table->timestamp('departure');

            $table->string('mobile_number')->nullable();

            $table->string('customer_name')->nullable();

            $table->string('channel')->default(Booking::BOOKING_CHANNEL_WEBSITE);

            $table->string('status')->default(Booking::BOOKING_STATUS_PENDING);

            $table->string('total_cost');

            $table->string('discount')->default('0');

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
