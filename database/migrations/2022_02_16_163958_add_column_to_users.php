<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->default(User::TYPE_PATIENT);
            $table->string('status')->default(User::STATUS_PENDING);
            $table->timestamp('birth_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'status',
                'address',
                'image',
                'type',
                'birth_date',
            ]);
        });
    }
}
