<?php

use App\Models\Shop;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->string('description');
            $table->string('address');
            $table->string('logo')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('status')->default(Shop::STATUS_OPEN);
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
        Schema::dropIfExists('shops');
    }
}
