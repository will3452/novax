<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealProperyTaxIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_property_tax_indices', function (Blueprint $table) {
            $table->id();
            $table->string('lgu');
            $table->integer('classification_id');
            $table->string('assessed_value');
            $table->string('tax_rate');
            $table->string('tax_index');
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
        Schema::dropIfExists('real_property_tax_indices');
    }
}
