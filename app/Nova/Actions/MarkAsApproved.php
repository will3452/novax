<?php

namespace App\Nova\Actions;

use App\Mail\BookingUpdate;
use App\Nova\Metrics\BookingStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class MarkAsApproved extends Action
{
    use InteractsWithQueue, Queueable;

    public function shownOnTableRow()
    {
        return true;
    }

    public function sendMessage($number, $reference) {
            $ch = curl_init();
            $parameters = array(
                'apikey' => env('SMS_KEY'),
                'number' => $number,
                'message' => "Good news from ODECOR-B CLINIC! Your booking (Ref: $reference ) is approved. See you soon!",
                'sendername' => 'OTIEPI'
            );
            curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
            curl_setopt( $ch, CURLOPT_POST, 1 );

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
        foreach($models as $model) {
            $model->update(['status' => 'Approved']);
            if ($model->patient->phone) {
                $this->sendMessage($model->patient->phone, $model->reference);
            }
            Mail::to([$model->patient->email])->send(new BookingUpdate($model));
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
