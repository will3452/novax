<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToVehicleRequestForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_request_forms', function (Blueprint $table) {
            $table->integer('travel_order_id')->nullable();
            $table->integer('request_of_travel_id')->nullable();
            $table->string('category')->default('Reserved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_request_forms', function (Blueprint $table) {
            //
        });
    }
}
