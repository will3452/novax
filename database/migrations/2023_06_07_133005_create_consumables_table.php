<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->integer('category_id');
            $table->string('bound');
            $table->string('status');
            $table->integer('quantity');
            $table->integer('remaining');
            $table->date('purchase_at');
            $table->date('purchase_cost');
            $table->integer('manufacturer_id');
            $table->integer('supplier_id');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->integer('asset_id');
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
        Schema::dropIfExists('consumables');
    }
}
