<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Transaction;
use App\Models\TravelHistory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function createTH(Request $request) {
        if ($request->has('lat') && $request->has('lng')) {
            TravelHistory::create([
                'lat' => $request->lat,
                'lng' => $request->lng,
                'destination_lat' => $request->lat,
                'destination_lng' => $request->lng, 
                'user_id' => $request->user_id
            ]);
        }
    }

    public function calculateDistanceInKm($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371; // Earth's radius in kilometers
    
        // Convert latitude and longitude from degrees to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
    
        // Haversine formula
        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;
    
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1) * cos($lat2) * sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        // Calculate the distance
        $distance = $earthRadius * $c;
    
        return $distance; // Distance in kilometers
    }

    public function updateCurrentFare(Request $request) {
        $userId = $request->userId;
        $user = User::find($userId); 
        if ($user->status != 'TRAVELING') return ['message' => 'not traveling...']; 
        $th = $user->travelHistories()->latest()->first(); 
        $kmDifference = $this->calculateDistanceInKm($th->lat, $th->lng, $request->lat, $request->lng) - 4; 

        $kmDifference = $kmDifference < 0 ? 0: $kmDifference; 

        User::find($userId)->update(['current_fare' => nova_get_setting('ads_fare', nova_get_setting('reg_fare')) * $kmDifference]); 
        
        return ['message' => 'ok']; 
    }
    

    public function pay (Request $request) {
        try {
            $data = $request->validate([
                'user_id' => ['required', 'exists:users,id'],
                'code' => ['required', 'exists:codes,code'],
                'purpose' => [],
                'auth_id' => ['required','exists:users,id'],
            ]);

            $data['amount'] = nova_get_setting('reg_fare'); //default  
            $data['purpose'] = 'Initial Payment'; 

            // check of the sender is traveling or not 
            
            $sender = User::find($data['user_id']);

            $status = $sender->status; 

            if ($status == 'TRAVELING') {
                $data['amount'] = $sender->current_fare; // ADDITION FARE 
                $data['purpose'] = 'additional fare'; 
                $sender->update(['current_fare' => 0]); 
            }

            if (! $sender) throw new Exception('Sender invalid');

            $receiver = User::find($data['auth_id']);

            if (! $receiver) throw new Exception('Receiver invalid');

            // check code

            $code = Code::whereUserId($sender->id)->whereCode($data['code'])->whereNull('used_at')->first();

            if (! $code) throw new Exception('Code invalid!');

            // check if has lat
            if ($status == "NOT_TRAVELING") {
                $this->createTH($request);
            } else {
                $sender->travelHistories()->latest()->first()->update(['destination_lat' => $request->lat, 'destination_lng' =>  $request->lng]); 
            }
            

            $code->update(['used_at' => now()]);

            $newBalance = $sender->deduct($data['amount']);

            $sender->createTransaction(Transaction::BOUND_OUT, Transaction::TYPE_PAY, $data['amount'], $data['purpose'], Transaction::STATUS_DONE, null);

            if ($newBalance === false ) throw new Exception('Insufficient Balance.');

            $receiver->add($newBalance);

            $receiver->createTransaction(Transaction::BOUND_IN, Transaction::TYPE_PAY, $data['amount'], $data['purpose'], Transaction::STATUS_DONE, $sender->id);

            $sender->update(['status' => $sender->status == 'NOT_TRAVELING' ? 'TRAVELING': 'NOT_TRAVELING']); 

            return ['pay' => true];

        } catch (Exception $error) {
            return ['pay' => false, 'message' => $error->getMessage()];
        }
    }

    // public function pay (Request $request) {
    //     try {
    //         $data = $request->validate([
    //             'amount' => ['required'],
    //             'user_id' => ['required', 'exists:users,id'],
    //             'code' => ['required', 'exists:codes,code'],
    //             'purpose' => [],
    //             'auth_id' => ['required','exists:users,id'],
    //         ]);

    //         $sender = User::find($data['user_id']);

    //         if (! $sender) throw new Exception('Sender invalid');

    //         $receiver = User::find($data['auth_id']);

    //         if (! $receiver) throw new Exception('Receiver invalid');

    //         // check code

    //         $code = Code::whereUserId($sender->id)->whereCode($data['code'])->whereNull('used_at')->first();

    //         if (! $code) throw new Exception('Code invalid!');

    //         // check if has lat
    //         $this->checkLocation($request);

    //         $code->update(['used_at' => now()]);

    //         $newBalance = $sender->deduct($data['amount']);

    //         $sender->createTransaction(Transaction::BOUND_OUT, Transaction::TYPE_PAY, $data['amount'], $data['purpose'], Transaction::STATUS_DONE, null);

    //         if ($newBalance === false ) throw new Exception('Insufficient Balance.');

    //         $receiver->add($newBalance);

    //         $receiver->createTransaction(Transaction::BOUND_IN, Transaction::TYPE_PAY, $data['amount'], $data['purpose'], Transaction::STATUS_DONE, $sender->id);


    //         return ['pay' => true];

    //     } catch (Exception $error) {
    //         return ['pay' => false, 'message' => $error->getMessage()];
    //     }
    // }

    public function getCode(Request $request) {
        try {

            $request->validate(['user_id' => 'required']);

            $exists = User::whereId($request->user_id)->exists();

            if (! $exists) throw new Exception('User invalid!');

            $code = Code::create(['user_id' => $request->user_id, 'code' => rand(123456,912345)]);

            return $code->code;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
