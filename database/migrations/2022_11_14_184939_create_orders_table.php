<?php

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->default("OR-". Str::random(8));
            $table->foreignId('user_id');
            $table->foreignId('discount_id')->nullable();
            $table->json('items');
            $table->string('status')->default(Order::STATUS_PENDING);
            $table->string('mop')->default(Order::MOP_COD);
            $table->string('delivery_fee')->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->string('amount_payable');
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
        Schema::dropIfExists('orders');
    }
}
