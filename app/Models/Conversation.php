<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $with = ['messages'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
