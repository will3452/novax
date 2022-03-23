<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetFeedbackRequest;
use App\Http\Requests\WriteFeedbackRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiFeedbackController extends Controller
{
    public function getFeedbacks(GetFeedbackRequest $r)
    {
        $r->validated();
        $product = Product::find($r->product_id);
        return response([
            'feedbacks' => $product->getFeedbacks($r->limit),
            'average_star' => $product->feedbacks()->avg('star'),
        ]);
    }

    public function storeFeedback(WriteFeedbackRequest $r)
    {
        $r->validated();

        return auth()->user()->writeFeedback($r->star, $r->message, $r->product_id, $r->order_id);
    }
}
