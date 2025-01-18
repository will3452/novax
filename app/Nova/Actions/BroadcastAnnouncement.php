<?php

namespace App\Nova\Actions;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class BroadcastAnnouncement extends Action
{
    use InteractsWithQueue, Queueable;

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
        $a = Announcement::find($fields['announcement']);
        foreach ($models as $model) {
            $this->sendMessage($model->phone, $a->body);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Announcement')
                ->options(Announcement::get()->pluck('title', 'id')),
        ];
    }
}
