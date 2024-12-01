<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationToVehicleRequestForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_request_forms', function (Blueprint $table) {
            $table->string('p_lat')->nullable();
            $table->string('p_long')->nullable();
            $table->string('d_lat')->nullable();
            $table->string('d_long')->nullable();
            $table->integer('vehicle_id')->nullable();
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
            $table->dropColumn(['p_lat', 'p_long', 'd_lat', 'd_long', 'vehicle_id']);
        });
    }
}
