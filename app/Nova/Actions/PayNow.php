<?php

namespace App\Nova\Actions;

use App\Models\DelayPayment;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\Revenue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class PayNow extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            Payment::create([
                'loan_id' => $model->loan_id,
                'user_id' => auth()->id(),
                'due_date' => $model->due_date,
                'amount' => $model->amount,
                'penalty' => 0,
            ]);

            if (now() > $model->due_date) {
                $loan = Loan::find($model->loan_id);
                DelayPayment::create([
                    'loan_id' => $model->loan_id,
                    'amount' => $model->amount,
                    'due_date' => $model->due_date,
                    'type' => $loan->type,
                ]);
            }
            $model->update(['status' => 'PAID']);
            Revenue::create(['amount' => $model->revenue]);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
