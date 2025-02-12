<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('from_branch_id')->nullable();
            $table->integer('from_warehouse_id')->nullable();
            $table->integer('to_branch_id')->nullable();
            $table->integer('to_warehouse_id')->nullable();
            $table->integer('quantity');
            $table->integer('initiated_by_id');
            $table->date('transfer_date');
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
        Schema::dropIfExists('stock_transfers');
    }
}
