<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function pay (Request $request) {
        try {
            $data = $request->validate([
                'amount' => ['required'],
                'user_id' => ['required', 'exists:users,id'],
                'code' => ['required', 'exists:codes,code'],
                'purpose' => [],
                'auth_id' => ['required','exists:users,id'],
            ]);

            $sender = User::find($data['user_id']);

            if (! $sender) throw new Exception('Sender invalid');

            $receiver = User::find($data['auth_id']);

            if (! $receiver) throw new Exception('Receiver invalid');

            // check code

            $code = Code::whereUserId($sender->id)->whereCode($data['code'])->whereNull('used_at')->first();

            if (! $code) throw new Exception('Code invalid!');

            $code->update(['used_at' => now()]);

            $newBalance = $sender->deduct($data['amount']);

            $sender->createTransaction(Transaction::BOUND_OUT, Transaction::TYPE_PAY, $data['amount'], $data['purpose'], Transaction::STATUS_DONE, null);

            if ($newBalance === false ) throw new Exception('Insufficient Balance.');

            $receiver->add($newBalance);

            $receiver->createTransaction(Transaction::BOUND_IN, Transaction::TYPE_PAY, $data['amount'], $data['purpose'], Transaction::STATUS_DONE, $sender->id);


            return ['pay' => true];

        } catch (Exception $error) {
            return ['pay' => false, 'message' => $error->getMessage()];
        }
    }

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
