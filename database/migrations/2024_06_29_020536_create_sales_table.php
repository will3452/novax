<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('store_id');
            $table->integer('order_item_id');
            $table->integer('order_id');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->integer('quantity_sold');
            $table->double('unit_price');
            $table->double('total_price');
            $table->double('discount')->default(0);
            $table->double('tax_applied')->default(0);
            $table->double('total_revenue');
            $table->string('payment_method');
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_province')->nullable();
            $table->string('shipping_postal')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_method')->nullable();
            $table->double('shipping_cost')->default(0);
            $table->string('shipping_status')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
