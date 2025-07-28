<?php

use App\Models\Sale;
use App\Models\SalesPayment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GeneratePaymentForOldSalesRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sales = Sale::whereStatus('CONFIRMED')->doesntHave('payments')->get();
        foreach ($sales as $sale) {
            SalesPayment::create([
                'sales_id' => $sale->id,
                'branch_id' => $sale->branch_id,
                'method' => $sale->payment_method,
                'type' => 'full',
                'cash' => $sale->total_amount,
                'change' => 0,
                'amount' => $sale->total_amount,
                'cashier_id' => $sale->cashier_id,
            ]);
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
