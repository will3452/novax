<?php

namespace App\Nova\Actions;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class Broadcast extends Action
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
        $ch = curl_init();
        $customers = Customer::get()->pluck('phone'); 
        foreach($models as $model) {
            $phones = []; 
            foreach($customers as $customer) {
                $array = explode('-', $customer); 
                $phone = implode('', $array); 
                array_push($phones, $phone); 
            }

            
            $parameters = array(
                'apikey' => nova_get_setting('SMS_KEY', env('SMS_KEY')), //Your API KEY
                'number' => implode(',', $phones),
                'message' => $model->content,
                'sendername' => nova_get_setting('SENDER_NAME', 'GOTRAKTORA'), 
            );

            curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
            curl_setopt( $ch, CURLOPT_POST, 1 );

            curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $output = curl_exec( $ch );
        }

        curl_close($ch); 
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
