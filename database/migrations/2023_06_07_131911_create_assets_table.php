<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('image')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->string('serial_no');
            $table->unsignedBigInteger('model_id');
            $table->boolean('bound');
            $table->string('status');
            $table->string('condition');
            $table->date('purchase_at');
            $table->decimal('purchase_cost', 10, 2);
            $table->unsignedBigInteger('manufacturer_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();

            //$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            //$table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
            //$table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');
            //$table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
