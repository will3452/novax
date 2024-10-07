<?php

use App\Models\PreOrder;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PreOrder::class, 'pre_order_id');
            $table->foreignIdFor(Product::class, 'product_id');
            $table->string('price');
            $table->integer('quantity')->default(1);
            $table->string('payable')->nullable();
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
        Schema::dropIfExists('pre_order_items');
    }
}
