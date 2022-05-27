<?php

namespace App\Models;

use App\Models\Traits\HasKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory, HasKey;
    protected $fillable = [
        'model_id',
        'model_type',
        'path',
        'opened_at',
        'key',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
