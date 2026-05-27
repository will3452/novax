<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('order_items', function (Blueprint $table) {
        // We use decimal for prices to ensure accuracy (e.g., 10,2 for ₱00.00)
        $table->decimal('price', 10, 2)->after('qty')->default(0);
    });
}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->dropColumn('price');
    });
}
}
