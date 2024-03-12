<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cover',
        'cover_1',
        'cover_2', 
        'excerpt',
        'content',
        'user_id', 
    ]; 

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function tags () {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id'); 
    }
}
