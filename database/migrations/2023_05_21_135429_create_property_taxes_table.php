<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('location');
            $table->string('owner');
            $table->integer('property_type_id');
            $table->string('assessed_value');
            $table->string('tax_rate');
            $table->string('effective_tax_rate');
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
        Schema::dropIfExists('property_taxes');
    }
}
