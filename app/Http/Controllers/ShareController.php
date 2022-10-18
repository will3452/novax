<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Item;
use App\Models\User;
use App\Models\Shared;
use App\Services\SmsCredit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShareController extends Controller
{


    public function sendApproval(User $requestor, Item $item, User $approver, $sharedId) {
        $requestorName = Str::limit($requestor->name, 20);
        $fileName = $item->name;
        $link = route('accept.request', ['w' => $item->key, 'k' => $requestor->id, 's' => $sharedId]);
        $message = "$requestorName, want to see your file [$fileName]. If you to continue and allow it, please go to this link; $link";
        $this->sendMessage($approver->phone, $message);
    }

    public function accessConfirm (Request $request) {

        if (! $request->has('w')) {
            return redirect('/');
        }
        $item = Item::where(['key' => $request->w])->first();

        if (! $item) {
            return redirect('/');
        }

        return view('access_confirm', compact('item'));
    }

    public function createRequest(Request $request) {
        try {
            $data = $request->validate([
                'message' => ['required', 'max:50'],
                'phone' => ['required', 'exists:users,phone'],
                'item_id' => ['required', 'exists:items,id']
            ]);

            $user = User::wherePhone($data['phone'])->first();

            $item = Item::find($data['item_id']);

            // check if the user is the same in the owner of the file
            if ($item->user_id == $user->id) throw new Exception('Invalid Operation this is already your file.');

            // check if requested already
            $isAlreadyShared = Shared::whereUserId($user->id)->whereItemId($item->id)->exists();

            if ($isAlreadyShared) throw new Exception('You already requested this file, please contact the owner for your approval.');

            $shared = Shared::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'message' => $data['message'],
            ]);

            if (SmsCredit::canSend()) {
                $this->sendApproval($user, $item, User::find($item->user_id), $shared->id);
            } else {
                throw new Exception('Insufficient load balance.');
            }

            return 'Your request has been sent to the owner.';
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function acceptRequest(Request $request) {
        try {

            $item = Item::where(['key' => $request->w])->first();


            if (! $item) throw new Exception('File not found.');

            $requestor = User::find($request->k);

            if (! $requestor) throw new Exception('Requestor not found.');

            $sharedRequest = Shared::whereUserId($requestor->id)->whereItemId($item->id)->first();

            if(! $sharedRequest) throw new Exception('Request not found.');

            return view('accept_confirm', compact('item', 'sharedRequest', 'requestor'));

        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    public function sendMessage($phone, $message) {
        $ch = curl_init();
        $apiKey = env('SMS_KEY');

        $parameters = array(
            'apikey' => $apiKey,
            'number' => $phone,
            'message' => $message,
            'sendername' => 'SEMAPHORE'
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages');
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        error_log('OUTPUT >> ' . $output);
    }

    public function confirmRequest(Request $request) {
        $request->validate([
            'id' => ['required', 'exists:shareds,id'],
        ]);

        $shared = Shared::find($request->id);
        $shared->update(['confirmed_at' => now()]);

        if (SmsCredit::canSend()) {
            $this->sendMessage($shared->user->phone, "Your request has been approved!");
        }


        return 'Approved request!';
    }
}
