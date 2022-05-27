<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Crypt;

trait HasKey
{
    public function encryptKey($key)
    {
        return Crypt::encryptString($key);
    }

    public function decryptKey($enc)
    {
        return Crypt::decryptString($enc);
    }

    public function isValid($key): bool
    {
        return $this->decryptKey($this->key) == $key;
    }
}
