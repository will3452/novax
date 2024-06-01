<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use KirschbaumDevelopment\NovaComments\Commentable;

class Announcement extends Model
{
    use HasFactory, Commentable;

    protected $fillable = [
        'subject',
        'body', 
    ]; 
}
