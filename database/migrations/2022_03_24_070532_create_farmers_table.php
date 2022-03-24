<?php

use App\Models\Farmer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('barangay');
            $table->string('address');
            $table->date('birth_date');
            $table->string('gender')->default(Farmer::GENDER_MALE);
            $table->text('beneficiary')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('is_4ps_family')->default(0);
            $table->string('name_of_spouse')->nullable();
            $table->string('civil_status')->default(Farmer::STATUS_MARRIED);
            $table->string('other_source_of_income')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
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
        Schema::dropIfExists('farmers');
    }
}
