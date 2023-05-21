<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('store_type_id');
            $table->string('location');
            $table->string('store_owner');
            $table->string('contact');
            $table->string('gross_sales');
            $table->string('expenses');
            $table->string('net_income');
            $table->string('taxable_income');
            $table->string('tax_rate');
            $table->string('total_tax');
            $table->string('tax_payment_status');
            $table->string('due_date');
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
        Schema::dropIfExists('stores');
    }
}
