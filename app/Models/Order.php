<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'remarks',
        'itemsBreakdown',
        'subTotal',
        'vatDue',
        'vatRate',
        'total',
        'user_id',
        'status',
    ];

    protected $with = [
        'pop',
    ];

    const STATUS_COMPLETED = 'Completed';
    const STATUS_DELIVERY = 'Delivery';
    const STATUS_PACKAGING = 'Packaging';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function markAs($status)
    {
        if (is_null($status)) {
            $status = self::STATUS_COMPLETED;
        }

        $this->update([
            'status' => $status,
        ]);
    }

    public function pop()
    {
        return $this->hasMany(Pop::class);
    }
}
