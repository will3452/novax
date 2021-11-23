<?php

use App\Models\Counselling;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounsellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counsellings', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->nullable();
            $table->text('case')->nullable();
            $table->text('plan')->nullable();
            $table->text('goal')->nullable();
            $table->text('recommendation')->nullable();
            $table->string('status')->default(Counselling::STATUS_DRAFTED);
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
        Schema::dropIfExists('counsellings');
    }
}
