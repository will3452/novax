<?php

namespace App\Observers;

use App\Models\Loan;
use App\Models\PaymentSchedule;

class LoanObserver
{
    public function generateDueDates($start_date, $end_date, $payment_times) {
        $due_dates = [];
        
        // Calculate the total number of days between start and end date
        $total_days = $end_date->diffInDays($start_date);
    
        // Calculate the interval in days between each payment
        $interval = floor($total_days / $payment_times);
    
        // Generate the due dates
        for ($i = 0; $i < $payment_times; $i++) {
            $due_dates[] = $start_date->copy()->addDays($i * $interval)->toDateString();
        }
    
        return $due_dates;
    }
    /**
     * Handle the Loan "created" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function created(Loan $loan)
    {
        $days = 1;

        if ($loan->payment_schedule == "WEEKLY") {
            $days = 7;
        } 
        

        if ($loan->payment_schedule == "MONTHLY") {
            $days = 30;
        } 

        $times = $loan->start_date->diffInDays($loan->end_date) / $days;

        $dues = $this->generateDueDates($loan->start_date, $loan->end_date, $times); 
        $amount = $loan->amount / $times; 
        $interest = $amount * (intval($loan->interest) / 100);
        $finalAmount = $amount + $interest; 
        foreach($dues as $due) {
            PaymentSchedule::create([
            'loan_id' => $loan->id, 
                'amount' => $finalAmount,
                'due_date' => $due, 
            ]);
        }
    }

    /**
     * Handle the Loan "updated" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function updated(Loan $loan)
    {
        //
    }

    /**
     * Handle the Loan "deleted" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function deleted(Loan $loan)
    {
        //
    }

    /**
     * Handle the Loan "restored" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function restored(Loan $loan)
    {
        //
    }

    /**
     * Handle the Loan "force deleted" event.
     *
     * @param  \App\Models\Loan  $loan
     * @return void
     */
    public function forceDeleted(Loan $loan)
    {
        //
    }
}
