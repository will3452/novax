<?php

namespace App\Nova\Actions;

use Carbon\Carbon;
use App\Models\SmsCredit;
use Illuminate\Bus\Queueable;
use App\Models\PaymentSchedule;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDueTodayReminder extends Action
{
    use InteractsWithQueue, Queueable;

    public function send () {

        $result = [];

        $dueToday = PaymentSchedule::whereDate('due_date', Carbon::today())->get();
        $dueToday->load('loan.users');
        $borrowers = collect();

        foreach($dueToday as $due) {
            foreach($due->loan->users as $b) {
                $borrowers->add($b->phone);
            }
        }
        $result = $borrowers->unique()->values()->all();

        $limit = nova_get_setting('sms_limit', 100);
        $credits = $limit - SmsCredit::count();


        if($credits < count($result)) return 'No Balance';



        foreach ($result as $r) {
            (new SmsCredit())->save();
        }

        $ch = curl_init();
        $parameters = array(
            'apikey' => nova_get_setting('sms_key', env('SMS_KEY')),
            'number' => implode(",", $result),
            'message' => nova_get_setting('sms_template', 'juantap: reminders please settle your loan.'),
            'sendername' => 'OTIEPI'
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages');
        curl_setopt( $ch, CURLOPT_POST, 1);


        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $this->send();

        return Action::message('Reminder has been sent!' );
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
