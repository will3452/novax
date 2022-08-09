<?php
namespace App\Models\Traits;

use App\Models\User;

trait BelongsToUserTrait
{
    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }
}
