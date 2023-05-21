<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('lgu');
            $table->string('business_type_id');
            $table->string('gross_sales');
            $table->string('tax_rate');
            $table->string('total_tax');
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
        Schema::dropIfExists('business_taxes');
    }
}
