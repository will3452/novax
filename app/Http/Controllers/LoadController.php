<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class LoadController extends Controller
{
    public function load (Request $request) {
        try {
            $data = $request->validate([
                'user_id' => ['required'],
                'amount' => ['required', 'min:1'],
            ]);

            if ($data['amount'] < 1) {
                throw new Exception('Amount invalid!');
            }

            $user = User::find($data['user_id']);

            if (! $user) {
                throw new Exception('User invalid!');
            }

            // create transaction
            Transaction::create([
                'user_id' => $user->id,
                'type' => Transaction::TYPE_LOAD,
                'bound' => Transaction::BOUND_IN,
                'purpose' => '',
                'status' => Transaction::STATUS_DONE, // for now
                'amount' => $data['amount'],
            ]);

            // TODO: // integrate gcash
            $user->update(['balance' => $user->balance + $data['amount']]);

            return ['success' => true];
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }
}
