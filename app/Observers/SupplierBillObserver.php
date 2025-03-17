<?php

namespace App\Observers;

use App\Models\SupplierBill;

class SupplierBillObserver
{
    /**
     * Handle the SupplierBill "created" event.
     *
     * @param  \App\Models\SupplierBill  $supplierBill
     * @return void
     */
    public function created(SupplierBill $supplierBill)
    {
        $po = $supplierBill->purchaseOrder;

        $supplierBill->update([
           'amount_due' => $po->total_cost,
           'supplier_id' => $po->supplier_id,
        ]);
    }

    /**
     * Handle the SupplierBill "updated" event.
     *
     * @param  \App\Models\SupplierBill  $supplierBill
     * @return void
     */
    public function updated(SupplierBill $supplierBill)
    {
        //
    }

    /**
     * Handle the SupplierBill "deleted" event.
     *
     * @param  \App\Models\SupplierBill  $supplierBill
     * @return void
     */
    public function deleted(SupplierBill $supplierBill)
    {
        //
    }

    /**
     * Handle the SupplierBill "restored" event.
     *
     * @param  \App\Models\SupplierBill  $supplierBill
     * @return void
     */
    public function restored(SupplierBill $supplierBill)
    {
        //
    }

    /**
     * Handle the SupplierBill "force deleted" event.
     *
     * @param  \App\Models\SupplierBill  $supplierBill
     * @return void
     */
    public function forceDeleted(SupplierBill $supplierBill)
    {
        //
    }
}
