<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_takes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_report_id');
            $table->foreignId('product_id')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->onDelete('cascade');
            $table->string('inventory_discrepancy')->nullable();
            $table->string('location')->nullable();
            $table->string('initial_number_of_stocks')->nullable();
            $table->string('current_physical_count')->nullable();
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
        Schema::dropIfExists('stock_takes');
    }
}
