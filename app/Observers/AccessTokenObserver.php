<?php

namespace App\Observers;

use App\Models\AccessToken;

class AccessTokenObserver
{
    public function creating (AccessToken $accessToken) {
        $accessToken->user_id = auth()->id();
        $accessToken->key = $accessToken->generateKey();
    }
}
