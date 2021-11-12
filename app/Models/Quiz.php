<?php

namespace App\Models;

use App\Models\Traits\HasQuestions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory, HasQuestions;
    protected $guarded = [];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
