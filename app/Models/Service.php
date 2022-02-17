<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'name',
        'description',
        'price',
        'status',
    ];

    const STATUS_AVAILABLE = 'Available';
    const STATUS_NOT_AVAILABLE = 'Not Available';

    public function setAvailable()
    {
        $this->update(['status' => self::STATUS_AVAILABLE]);
    }

    public function setNotAvailable()
    {
        $this->update(['status' => self::STATUS_NOT_AVAILABLE]);
    }

    public function isAvailable()
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    public function isNotAvailable()
    {
        return $this->status === self::STATUS_NOT_AVAILABLE;
    }

}
