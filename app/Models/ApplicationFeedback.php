<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationFeedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'employer_id',
        'application_id',
        'applicant_id',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function application()
    {
        return $this->belongsTo(JobApplication::class, 'application_id');
    }
}
