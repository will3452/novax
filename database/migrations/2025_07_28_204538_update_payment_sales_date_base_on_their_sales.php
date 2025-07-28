<?php

use App\Models\Sale;
use App\Models\SalesPayment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentSalesDateBaseOnTheirSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $records = Sale::whereStatus('CONFIRMED')->get();
        foreach ($records as $record) {
            SalesPayment::whereSalesId($record->id)->update(['created_at' => $record->date]);
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
