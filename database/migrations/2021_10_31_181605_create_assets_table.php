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
            $table->string('description')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('purchase_cost')->nullable();
            $table->string('location')->nullable();
            $table->string('owner')->nullable();
            $table->string('users')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('insurance_coverage')->nullable();
            $table->string('current_value')->nullable();
            $table->string('depreciation_method_used')->nullable();
            $table->string('manufacturers_warranty')->nullable();
            $table->string('maintenance_information')->nullable();
            $table->string('life_expectancy')->nullable();
            $table->string('estimated_resale_value')->nullable();
            $table->foreignId('user_id');
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
        Schema::dropIfExists('assets');
    }
}
