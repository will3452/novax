<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'picture',
        // 'address',
        // 'about',
        // 'user_id',
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('picture')->nullable();
            $table->string('address')->nullable();
            $table->text('about')->nullable();
            $table->foreignId('user_id')->onDelete('constrain');
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
        Schema::dropIfExists('profiles');
    }
}
