<?php

use App\Models\Sale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSalesType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sales = Sale::get();
        foreach ($sales as $sale) {
            if ($sale->items()->count() == 0) continue;
            // dd($sale->items()->count() == 0);
            $type = $sale->items()->first()->salable_type == 'App\Models\Product' ? 'SALES': 'SERVICE';
            $sale->update(['type' => $type]);
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
