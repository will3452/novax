<?php

namespace App\Models\Traits;

use App\Models\Feedback;

trait HasFeedback
{
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    public function writeFeedback($star = 5, $message = "Great Products!", $pId, $oId = null)
    {
        return $this->feedbacks()->create([
                'star' => $star,
                'message' => $message,
                'product_id' => $pId,
                'order_id' => $oId,
            ]);
    }

    public function getFeedbacks( $limit = 5)
    {
        return $this->feedbacks()->limit($limit)->get();
    }
}
