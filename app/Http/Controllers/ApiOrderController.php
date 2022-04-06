<?php

namespace App\Http\Controllers;

use App\Models\Pop;
use App\Models\Order;
use App\Http\Requests\MarkAsRequest;
use Intervention\Image\Facades\Image;

class ApiOrderController extends Controller
{
    public function getOrders()
    {
        return auth()->user()->orders;
    }

    public function markAsCompleted(MarkAsRequest $r)
    {
        $data = $r->validated();
        Order::find($r->order_id)->markAs(Order::STATUS_COMPLETED);

        $image = time();

        Image::make($data['image'])
            ->encode('png', 75)
            ->resize(75, 150)
            ->save(public_path("img/products/$image.png"));

        $data['image'] = "img/products/$image.png";

        Pop::create([
            'order_id' => $r->order_id,
            'image' => $data['image'],
        ]);

        return $this->getOrders();
    }
}
