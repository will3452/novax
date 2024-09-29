<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleRequestFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_request_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('model');
            $table->text('purpose');
            $table->date('date');
            $table->string('remarks');
            $table->string('request_travel');
            $table->string('travel_order');
            $table->string('status'); 
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
        Schema::dropIfExists('vehicle_request_forms');
    }
}
