<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('serial');
            $table->integer('category_id');
            $table->integer('model_id');
            $table->string('bound');
            $table->string('status');
            $table->integer('condition_id');
            $table->date('purchase_at');
            $table->string('purchase_cost');
            $table->integer('manufacturer_id');
            $table->integer('supplier_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('components');
    }
}
