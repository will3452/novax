<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'project_id',
        'description',
        'country',
        'address',
        'client_id',
        'attachments',
        'start_date',
        'end_date',
        'revenue',
        'status_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class, 'classification_id');
    }
}
