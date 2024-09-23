<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('INDIVIDUAL');
            $table->integer('terms')->default(7); // 1 week 
            $table->double('amount')->default(1000);
            $table->string('interest')->nullable();
            $table->string('payment_schedule'); 
            $table->date('start_date');
            $table->date('end_date');
            $table->string('collateral')->nullable();
            $table->string('collateral_image')->nullable(); 
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
        Schema::dropIfExists('loans');
    }
}
