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
            $table->foreignId('trip_id');
            $table->json('trip_details');
            $table->dateTime('date');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default(Booking::STATUS_FOR_REVIEW);
            $table->string('amount_payable');
            $table->integer('qty')->default(1);
            $table->string('discount_image_proof')->nullable();
            $table->foreignId('discount_id')->nullable();
            $table->timestamp('paid_at')->nullable();
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
