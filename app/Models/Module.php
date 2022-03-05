<?php

namespace App\Models;

use App\Models\Traits\HasRecords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory,
        HasRecords;

    protected $fillable = [
        'subject_id',
        'uploader_id', //uploader id
        'name',
        'code',
        'type', // synchronous and asynch
    ];

    protected $with = ['activities', 'materials'];

    const TYPE_SYNCHRONOUS = 'Synchronous';
    const TYPE_ASYNCHRONOUS = 'Asynchronous';

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
