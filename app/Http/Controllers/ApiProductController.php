<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ApiProductController extends Controller
{
    public function products()
    {
        return Product::latest()->get();
    }

    public function updateQuantity(ProductUpdateRequest $p)
    {
        $p->validated();

        $pd = Product::find($p->product_id)->update([
            'quantity' => $p->quantity,
        ]);

        return $pd;
    }

    public function store(ProductStoreRequest $r)
    {
        $data = $r->validated();

        $image = time();

        Image::make($data['image'])
            ->encode('png', 75)
            ->resize(75, 150)
            ->save(public_path("img/products/$image.png"));

        $data['image'] = "img/products/$image.png";

        $data['store_id'] = auth()->user()->id;

        $product = Product::create($data);

        return response([
            'product' => $product,
        ], 200);
    }

    public function myProducts()
    {
        return auth()->user()->products;
    }

    public function master()
    {
        $user = User::WhereNotNull('approved_as_store_owner_at')->get();
        $category = null;

        $lists = [
                "Vegetable",
                "Fruit",
                "Meat",
                "Fish",
                "Dairy",
                "Poultry",
                "Seeds",
                "Plant",
            ];

        foreach ($user as $u) {
            foreach ($lists as $list) {
                $u[$list] = Product::whereCategory($list)->get();
            }
        }

        return $user;
    }
}
