<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'amount',
        'uom',
    ];

    public static function getUnit()
    {
        $units = nova_get_setting('uom');
        $arr = explode(',', $units);
        if (! count($arr)) {
            return [
                'pc' => 'pc',
                'sack' => 'sack',
            ];
        }
        $options = [];
        foreach ($arr as $value) {
            $options[$value] = $value;
        }
        return $options;
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
