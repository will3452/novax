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
        $schedule = $loan->payment_schedule;


        $times = $loan->number_of_installment;

        $interest = ((intval($loan->interest??'0') / 100 ) * $loan->amount * $times);
        $finalAmount = ($loan->amount + $interest) / $times;
        for ($i = 1; $i <= $times; $i++) {
            $due = now()->addDay($i);
            if ($schedule == "WEEKLY") {
                $due = now()->addWeek($i);
            } else if ($schedule == "MONTHLY") {
                $due = now()->addMonth($i);
            }

            PaymentSchedule::create([
            'loan_id' => $loan->id,
                'amount' => $finalAmount,
                'due_date' => $due,
                'revenue' => $interest,
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
