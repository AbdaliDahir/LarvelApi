<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


/**
* Users
**/
Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);

/**
* Buyers
**/
Route::resource('buyers', 'Buyer\BuyerController', ['only' => ['index', 'show']]);
Route::resource('buyers.transactions','Buyer\BuyerTransactionController', ['only' => ['index']]);
Route::resource('buyers.products','Buyer\BuyerProductController', ['only' => ['index']]);
Route::resource('buyers.sellers','Buyer\BuyerSellerController', ['only' => ['index']]);
Route::resource('buyers.categories','Buyer\BuyerCategoryController', ['only' => ['index']]);


/**
* Seller
**/
Route::resource('sellers', 'Seller\SellerController', ['only' => ['index', 'show']]);

/**
* Categories
**/
Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);

/**
* Products
**/
Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show']]);

/**
* Transactions
**/
Route::resource('transactions', 'transaction\TransactionController', ['only' => ['index', 'show']]);
Route::resource('transactions.categories','transaction\TransactionCategoryController',['only' => ['index']]);
Route::resource('transactions.sellers', 'transaction\TransactionSellerController', ['only' => ['index']]);