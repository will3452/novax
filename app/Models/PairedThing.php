<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PairedThing extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_1',
        'item_2',
    ];
}
