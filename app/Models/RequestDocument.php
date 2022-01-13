<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document',
        'user_request_id',
    ];

    public function getPublicDocumentAttribute()
    {
        return "/" . str_replace('public', 'storage', $this->document);
    }

    public function userRequest()
    {
        return $this->belongsTo(UserRequest::class);
    }
}
