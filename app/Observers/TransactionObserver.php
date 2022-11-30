<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\Package;
use App\Models\Transaction;

class TransactionObserver
{
    public function creating (Transaction $transaction) {
        if (! $transaction->reference) {
            $transaction->reference = "REF-" . now()->timestamp;
        }


        if (! $transaction->balance && $transaction->client_id) {

            // get the selected package
            $client = Client::find($transaction->client_id);
            $package = Package::find($client->package_id);

            $transaction->balance = $transaction->amount - $package->price;
        }
    }
}
