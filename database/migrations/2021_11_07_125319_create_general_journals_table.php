<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_journal_remark_id');
            $table->foreignId('user_id');
            $table->string('account');
            $table->text('description')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('debit')->nullable();
            $table->string('credit')->nullable();
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
        Schema::dropIfExists('general_journals');
    }
}
