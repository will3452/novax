<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    const STATUS_RESOLVED = 'resolved';
    const STATUS_UNRESOLVED = 'unresolved';


    protected $fillable = [
        'user_id',
        'document_id',
        'name',
        'document',
        'amount',
        'description',
        'proof_of_payment',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function requestDocument()
    {
        return $this->hasOne(RequestDocument::class);
    }
}
