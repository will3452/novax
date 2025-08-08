<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCreatedAtOfInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $records = \App\Models\Invoice::with('sale')->get();
        foreach ($records as $rec) {
            $date = $rec->sale ? $rec->sale->date : $rec->created_at;
            $rec->update(['created_at' => $date]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
