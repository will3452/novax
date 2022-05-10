<?php

use App\Http\Controllers\ApiApproveSellerController;
use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiCartController;
use App\Http\Controllers\ApiFeedbackController;
use App\Http\Controllers\ApiFollowController;
use App\Http\Controllers\ApiNotificationController;
use App\Http\Controllers\ApiOrderController;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\ApiProfileController;
use App\Http\Controllers\ApiSalesController;
use App\Http\Controllers\ApiSearchProductController;
use App\Http\Controllers\ApiWishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\BackupTool\Http\Controllers\ApiController;

//private access
Route::middleware('auth:sanctum')->group(function () {

    //follow and unfollow
    Route::post('follow/{store}', [ApiFollowController::class, 'follow']);
    Route::post('unfollow/{store}', [ApiFollowController::class, 'unfollow']);

    Route::get('notifications', [ApiNotificationController::class, 'getNotifications']);
    //approve seller
    Route::post('/approve-seller', [ApiApproveSellerController::class, 'approve']);

    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
    Route::post('/products', [ApiProductController::class, 'store']);
    Route::get('/my-products', [ApiProductController::class, 'myProducts']);

    //cart items
    Route::get('/get-cart-items', [ApiCartController::class, 'getCartItems']);
    Route::post('/add-to-cart', [ApiCartController::class, 'addToCart']);
    Route::post('/remove-to-cart', [ApiCartController::class, 'removeToCart']);
    Route::post('clear-cart', [ApiCartController::class, 'clearCart']);
    Route::post('checkout', [ApiCartController::class, 'processCartToOrder']);

    //wishlists
    Route::get('/get-wishlist', [ApiWishlistController::class, 'getWishlist']);
    Route::post('/clear-wishlist', [ApiWishlistController::class, 'clearWishlist']);
    Route::post('/add-to-wishlist', [ApiWishlistController::class, 'addToWishlist']);
    Route::post('/remove-to-wishlist', [ApiWishlistController::class, 'removeWishlist']);

    //profile
    Route::get('/my-profile', [ApiProfileController::class, 'myProfile']);
    Route::post('/update-profile', [ApiProfileController::class, 'updateProfile']);

    //orders | consumer
    Route::get('/orders', [ApiOrderController::class, 'getOrders']);
    Route::post('/mark-order-as-completed', [ApiOrderController::class, 'markAsCompleted']);

    //sales | seller
    Route::get('/sales', [ApiSalesController::class, 'getSales']);

    Route::get('/my-store-orders', [ApiSalesController::class, 'getStoreOrders']);

    Route::post('/write-feedback', [ApiFeedbackController::class, 'storeFeedback']);
    Route::post('/update-quantity', [ApiProductController::class, 'updateQuantity']);
    Route::post('/update-price', [ApiProductController::class, 'updatePrice']);

    Route::get('/store-master', [ApiProductController::class, 'master']);
});

Route::get('/public-test', function () {
    return 'public test';
});

//get feedback of product
Route::get('/feedback-products', [ApiFeedbackController::class, 'getFeedbacks']);

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);
Route::post('/request-verification-code', [ApiAuthenticationController::class, 'requestVerificationCode']);
Route::post('/submit-verification-code', [ApiAuthenticationController::class, 'submitCode']);

Route::get('/products', [ApiProductController::class, 'products']);

Route::get('/search-products', [ApiSearchProductController::class, 'search']);
