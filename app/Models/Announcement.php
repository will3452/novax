<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KirschbaumDevelopment\NovaComments\Commentable;

class Announcement extends Model
{
    use HasFactory, Commentable, SoftDeletes;

    protected $fillable = [
        'subject',
        'body', 
    ]; 
}
