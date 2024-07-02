<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stores = [];
        if ($request->has('random')) {
            $limit = $request->limit ?? 12;
            $stores = Store::whereHas('products')->inRandomOrder()->take($limit)->get();
            $stores->load(['owner', 'products']);
        } else if ($request->has('search')) {
            $search = $request->search;
            $stores = Store::where("name", "LIKE", "%$search%")
                ->whereHas('products')
                ->latest()
                ->get();
        } else {
            $stores = Store::whereHas('products')->latest()->get();
        }

        $stores->load(['owner', 'products']);
        return $stores;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    function getFile($path) {
        $pathArray = explode("/", $path);
        return end($pathArray);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->data;
        $logo = $this->getFile($request->logo->store('public'));
        $banner = $this->getFile($request->logo->store('public'));
        $object = json_decode($data);
        $user = \App\Models\User::create([
            'name' => $object->user_name,
            'email' => $object->user_email,
            'password' => bcrypt($object->user_password),
            'type' => 'VENDOR',
        ]);

        $store = Store::create([
            'user_id' => $user->id,
            'name' => $object->name,
            'phone' => $object->phone,
            'address' => $object->address,
            'city' => $object->city,
            'provice' => $object->province,
            'postal' => $object->postal,
            'business_license_number' => $object->business_license_number,
            'tax_identification_number' => $object->tax_identification_number,
            'description' => $object->description,
            'category' => $object->category,
        ]);

        return $store;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $store->load(['owner', 'products']);
        return $store;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
