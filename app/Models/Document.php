<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use KirschbaumDevelopment\NovaComments\Commentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory, Commentable;
    protected $fillable = [
        'name',
        'category',
        'file',
        'status',
        'user_id',
        'awarded_at', // for bid winners
    ];

    const STATUS_RESOLVED = 'RESOLVED';
    const STATUS_PENDING = 'PENDING';

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function participants () {
        return $this->belongsToMany(User::class);
    }

    public function activities () {
        return $this->hasMany(Activity::class);
    }

    public function links () {
        return $this->hasMany(Link::class);
    }

    public function getWarningsAttribute() {
        if ($this->participants()->count() == 0) {
            return "Please add participants";
        }

        if ($this->links()->count() == 0) {
            return "Please add Meeting links";
        }

        return "";
    }
}
