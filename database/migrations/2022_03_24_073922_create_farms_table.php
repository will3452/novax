<?php

use App\Models\Farm;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->string('crops');
            $table->string('barangay');
            $table->string('address');
            $table->string('total_farm_area');
            $table->text('coordinates')->nullable();
            $table->string('color')->nullable();
            $table->string('fill')->nullable();
            $table->string('land_owner')->nullable();
            $table->string('tenure_type');
            $table->string('size');
            $table->boolean('is_organically_grown')->default(1);
            $table->string('source_of_water')->default(Farm::SOW_DEEP_WELL);
            $table->foreignId('farmer_id')
                ->onDelete('cascade');
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
        Schema::dropIfExists('farms');
    }
}
