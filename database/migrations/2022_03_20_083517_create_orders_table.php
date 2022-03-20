<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('address')->nullable();
            $table->string('remarks')->nullable();
            $table->text('itemsBreakdown');
            $table->string('subTotal');
            $table->string('vatDue');
            $table->string('vatRate');
            $table->string('total');
            $table->foreignId('user_id')
                ->nullable()
                ->onDelete('set null');
            $table->string('status')->default(Order::STATUS_PACKAGING);
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
