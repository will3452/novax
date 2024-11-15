<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentitionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'tooth_number',
        'status',
        'record_id',
    ];

    public static function toothNumber () {
        return [
        55 => 55,
            54 => 54,
            53 => 53,
            52 => 52,
            51 => 51,
            61 => 61,
            62 => 62,
            63 => 63,
            64 => 64,
            65 => 65,
            18 => 18,
            17 => 17,
            16 => 16,
            15 => 15,
            14 => 14,
            13 => 13,
            12 => 12,
            11 => 11,
            21 => 21,
            22 => 22,
            23 => 23,
            24 => 24,
            25 => 25,
            26 => 26,
            27 => 27,
            28 => 28,
            48 => 48,
            47 => 47,
            46 => 46,
            45 => 45,
            44 => 44,
            43 => 43,
            42 => 42,
            41 => 41,
            31 => 31,
            32 => 32,
            33 => 33,
            34 => 34,
            35 => 35,
            36 => 36,
            37 => 37,
            38 => 38,
            85 => 85,
            84 => 84,
            83 => 83,
            82 => 82,
            81 => 81,
            71 => 71,
            72 => 72,
            73 => 73,
            74 => 74,
            75 => 75,
        ];
    }

    public function record () {
        return $this->belongsTo(DentalRecord::class, 'record_id');
    }
}
