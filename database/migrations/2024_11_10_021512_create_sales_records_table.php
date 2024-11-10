<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_records', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->double('total');
            $table->enum('source', ['PRE-ORDER', 'ORDER'])->default('ORDER');
            $table->integer('source_id');
            $table->json('items')->nullable();
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
        Schema::dropIfExists('sales_records');
    }
}
