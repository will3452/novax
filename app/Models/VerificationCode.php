<?php

namespace App\Models;

use App\Semaphore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerificationCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipient',
        'message',
        'status', // used, not used
        'code',
    ];

    const STATUS_NOT_USED = 'Not used';
    const STATUS_USED = 'Used';

    const MESSAGE = ' is your verification code. For your protection, do not share this code with anyone.';

    public static function generateCode()
    {
        return rand(1234, 9876);
    }

    public static function smsHandler($phone)
    {
        $code = self::generateCode();
        $message = $code . self::MESSAGE;

        $sms = new Semaphore($phone, $message);


        $result = $sms->send();

        self::create([
            'recipient' => $phone,
            'code' => $code,
            "message" => $result
        ]);
    }
}
