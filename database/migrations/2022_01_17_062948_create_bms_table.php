<?php

use App\Models\Bms;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->onDelete('cascade');
            $table->string('weight');
            $table->string('height');
            $table->integer('age');
            $table->string('result');
            $table->string('type')->default(Bms::TYPE_BMI);
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
        Schema::dropIfExists('bms');
    }
}
