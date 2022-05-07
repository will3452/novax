<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Storage;

class AES128 extends Encrypter
{
    public function __construct($key)
    {
        parent::__construct($key, 'aes-128-cbc');
    }

    public static function generateKey($cipher = 'aes-128-cbc')
    {
        return parent::generateKey($cipher);
    }

    public static function saveFile($encrypted, $isDec=false)
    {
        $filename = '';
        if (! $isDec) {
            $filename = Str::uuid() . '.dat';
        } else {
            $filename = Str::uuid() . '.png';
        }

        Storage::put("public/$filename", $encrypted);
        return $filename;
    }

    public static function storeFile($file) // key, filepath
    {
        $content = $file;
        $key = bin2hex(random_bytes(8));
        $aes = new self($key);
        $encrypted = $aes->encrypt(file_get_contents($content));
        $filename = self::saveFile($encrypted);
        return [
            $key,
            $filename,
        ];
    }
}
