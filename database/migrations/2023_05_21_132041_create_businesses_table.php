<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('business_type_id');
            $table->string('registration_number');
            $table->string('location');
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
        Schema::dropIfExists('businesses');
    }
}
