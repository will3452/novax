<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'product_key',
        'bound',
        'status',
        'expired_at',
        'purchase_cost',
        'purchase_at',
        'manufacturer_id',
        'supplier_id',
        'user_id',
        'asset_id',
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assetModel()
    {
        return $this->belongsTo(AssetModel::class, 'model_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
