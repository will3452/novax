<?php

namespace App\Nova\Actions;

use App\Models\LoanMatrix;
use App\Models\Application;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyForLoan extends Action
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
        $hasExists = Application::whereStatus(Application::STATUS_FOR_APPROVAL)->exists();

        if ($hasExists) {
            return Action::danger('You have pending application.');
        }

        // check if profile is setup
        if (! auth()->user()->profile) {
            return Action::danger('Please setup your profile first.');
        }

        $loans = LoanMatrix::get();

        $loanable = null;

        $salary = auth()->user()->profile->monthly_salary;

        foreach ($loans as $l) {
            if ($l->min <= $salary && $l->max >= $salary) {
                $loanable = $l;
            }
        }
        // $loanable = LoanMatrix::where('min', '>=', auth()->user()->profile->monthly_salary)->where('max', '<=', auth()->user()->profile->monthly_salary)->first();

        if (! $loanable) {
            return Action::danger('your application will not be passed based on your profile.');
        }

        $loanableValue = $loanable->value;

        $payable = (((nova_get_setting('ir', 5) / 100) * $loanableValue) + $loanableValue) / nova_get_setting('nmp', 6);

        Application::create([
            'user_id' => auth()->id(),
            'reference' => "LOAN-".Str::random(6),
            'monthly_payable' => $payable ,
        ]);
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
