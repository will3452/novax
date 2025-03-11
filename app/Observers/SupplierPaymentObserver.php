<?php

namespace App\Observers;

use App\Models\SupplierBill;
use App\Models\SupplierPayment;

class SupplierPaymentObserver
{
    /**
     * Handle the SupplierPayment "created" event.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return void
     */
    public function created(SupplierPayment $supplierPayment)
    {
        $totalPayments = SupplierPayment::whereSupplierBillId($supplierPayment->supplier_bill_id)->sum('amount_paid');
        if ($totalPayments >= $supplierPayment->supplierBill->amount_due) {
            $bill = SupplierBill::findOrFail($supplierPayment->supplier_bill_id);
            $bill->status = 'PAID';
            $bill->save();
        }
    }

    /**
     * Handle the SupplierPayment "updated" event.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return void
     */
    public function updated(SupplierPayment $supplierPayment)
    {
        //
    }

    /**
     * Handle the SupplierPayment "deleted" event.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return void
     */
    public function deleted(SupplierPayment $supplierPayment)
    {
        //
    }

    /**
     * Handle the SupplierPayment "restored" event.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return void
     */
    public function restored(SupplierPayment $supplierPayment)
    {
        //
    }

    /**
     * Handle the SupplierPayment "force deleted" event.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return void
     */
    public function forceDeleted(SupplierPayment $supplierPayment)
    {
        //
    }
}
