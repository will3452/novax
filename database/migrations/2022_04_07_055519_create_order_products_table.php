<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('order_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('product_id')
                ->onDelete('set null')
                ->nullable();
            $table->string('product_category')
                ->nullable();
            $table->string('product_name')
                ->nullable();
            $table->string('cooperative')
                ->nullable();
            $table->string('product_price')
                ->nullable();
            $table->string('order_quantity')
                ->nullable();
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
        Schema::dropIfExists('order_products');
    }
}
