<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->string('invoice_no')->nullable();
            $table->string('po_no')->nullable();
            $table->string('amount_due')->nullable();
            $table->date('due_date')->nullable();
            $table->string('status')->default('PENDING');
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
        Schema::dropIfExists('supplier_bills');
    }
}
