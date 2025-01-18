<?php

namespace App\Nova\Actions;

use App\Models\BroadcastLog;
use App\Models\SmsBalance;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class Broadcast extends Action
{
    use InteractsWithQueue, Queueable;

    public $showOnTableRow = true;

    public function sendMessage($phone, $message) {
        $ch = curl_init();
        $parameters = array(
            'apikey' => ENV('SMS_KEY'), //Your API KEY
            'number' => $phone,
            'message' => $message,
            'sendername' => 'JUANCAST'
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        //Show the server response
        return;
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
        $users = User::get();
        foreach($models as $model) {
            if ( SmsBalance::latest()->first()->amount <= 0) return Action::danger("You don't have enough SMS Balance.");
            foreach($users as $user) {
                BroadcastLog::create([
                    'user_id' => $user->id,
                    'announcement_id' => $model->id,
                ]);
                if (! $user->phone) continue;
                $this->sendMessage($user->phone, $model->body);
                SmsBalance::create([
                    'amount' => SmsBalance::latest()->first()->amount - 2,
                ]);
            }
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
