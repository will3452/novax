<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name');
            $table->string('branch_address')->nullable();
            $table->boolean('is_cash_sales')->default(false);
            $table->boolean('is_charge_sales')->default(false);
            $table->string('customer_name')->nullable();
            $table->string('customer_tin')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('total_sales')->default('0');
            $table->string('total_amount_due')->default('0');
            $table->integer('sale_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->json('items')->nullable();
            $table->string('cashier')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
