<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'image',
        'name',
        'category_id',
        'serial_no',
        'model_id',
        'bound',
        'status',
        'condition',
        'purchase_at',
        'purchase_cost',
        'manufacturer_id',
        'supplier_id',
        'user_id',
        'department_id',
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
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
