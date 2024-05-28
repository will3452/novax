<?php

use App\Models\Panellist;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPanellists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panellists', function (Blueprint $table) {
            $table->string('type')->default(Panellist::TYPE_MEMBER);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('panellists', function (Blueprint $table) {
            //
        });
    }
}
