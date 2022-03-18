<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductStoreRequest;

class ApiProductController extends Controller
{
    public function products()
    {
        return Product::latest()->get();
    }

    public function store(ProductStoreRequest $r)
    {
        $data = $r->validated();

        $image = time();

        $data['image'] = Image::make($data['image'])
            ->encode('png', 75)
            ->save(public_path("img/products/$image.png"));

        $data['store_id'] = auth()->user()->id;

        Product::create($data);
    }
}
