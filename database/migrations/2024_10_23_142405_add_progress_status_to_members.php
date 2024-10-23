<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgressStatusToMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->enum('progress_status', ['Regular', '1st', '2nd', '3rd', '4th', 'Visitor'])->default('1st');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('progress_status');
        });
    }
}
