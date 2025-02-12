<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory_id');
            $table->integer('product_id');
            $table->integer('branch_id');
            $table->integer('warehouse_id');
            $table->bigInteger('old_quantity');
            $table->bigInteger('new_quantity');
            $table->bigInteger('change_amount');
            $table->enum('change_type', ['Sale', 'Delivery', 'Stock_transfer']);
            $table->integer('change_by_id');
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('inventory_logs');
    }
}
