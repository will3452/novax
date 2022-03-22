<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\RegisterController;
use App\Models\Category;

Route::get('/', function (Request $request) {
    $products = Product::where('category', "LIKE", "%" . ($request->category ?? "") . "%")
        ->where("description", "LIKE", "%" . ($request->description ?? "") . "%")
        ->whereHas('inventories', function (Builder $e) {
            return $e->where('quantity', '!=', 0);
        })
        ->get();
    return view('welcome', compact('products'));
})->middleware(['auth.basic']);



//cashiering

Route::get('/add-item/{id}', function (Request $request, $id) {
    auth()->user()->addItem($id, $request->quantity);
    return back();
});

Route::get('/remove-item/{id}', function ($id) {
    auth()->user()->removeItem($id);
    return back();
});

Route::get('/update-quantity/{id}', function (Request $request, $id) {
    auth()->user()->updateQuantity($id, $request->quantity);
    return back();
});

Route::post('/process-order', function (Request $request) {
    $request->validate([
        'cash' => ['required', 'gt:0'],
        'change' => 'required',
    ]);

    auth()->user()->processSales($request->cash, $request->change);
    return back();
});

//

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
