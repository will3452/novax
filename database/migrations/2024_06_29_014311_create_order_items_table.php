<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('quantity')->default(1);
            $table->double('unit_price');
            $table->string('payment_method');
            $table->string('payment_status'); 
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_province')->nullable();
            $table->string('shipping_postal')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_method')->nullable();
            $table->double('shipping_cost')->default(0);
            $table->string('shipping_status')->nullable();
            $table->string('discount_code')->nullable();
            $table->double('discount_amount')->default(0);
            $table->string('tax_rate')->nullable();
            $table->double('tax_amount')->default(0);
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
        Schema::dropIfExists('order_items');
    }
}
