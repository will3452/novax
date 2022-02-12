<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_id',
        'model_type',
        'path',
        'opened_at',
        'key', // this will use to decrypts the content of the image
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
