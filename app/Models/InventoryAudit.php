<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAudit extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'card_name',
        'action',
        'changes'
    ];
    protected $casts = [
        'changes' => 'array',
    ];

    public static function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
