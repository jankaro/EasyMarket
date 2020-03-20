<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Category;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/product', function () {
    return view('pages.productView');
});

Route::get('/auction', function () {
    return view('pages.auction');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/store', 'HomeController@store')->name('store');
Route::get('/profile','UserController@index')->name('profile');
Route::post('/profile/update/{id}', 'UserController@update');
Route::post('/profile/update/payment/{id}', 'UserController@paymentUpdate');

Route::get('/profile/orders', function (){
    $currentUser = User::find(Auth::id());
    $orders = $currentUser->orders;
    return view('users.orders', compact('currentUser','orders'));
})->name('orders');

Route::get('/profile/seller/auth', function (){

    $currentUser = User::find(Auth::id());
    $seller_info = $currentUser->sellers;
    return view('sellers.sellerAuth',compact('currentUser', 'seller_info'));
})->name('seller_auth');

Route::post('/profile/seller/auth/submit={id}', 'UserController@sellerAuth');

// seller posted products
Route::get('/profile/seller/products', 'ProductsController@showProducts')->name('seller_products');

Route::get('/profile/seller/add-product','ProductsController@index')->name('products_index');
Route::post('/profile/seller/add-product={id}', 'ProductsController@addProduct');
Route::get('/profile/seller/manage-orders','ProductsController@showOrders')->name('orders_management');
Route::post('/profile/seller/manage-orders/change','ProductsController@ChangeOrderStatus')->name('change_status');
Route::post('/profile/seller/update-product', 'ProductsController@updateProduct');


Route::get('/profile/seller/auctions', function (){

    $products = Product::where('is_active', true)->get();
    $categories = Category::all();
    return view('home', compact('products','categories'));
});

Route::post('/profile/seller/open-auction', 'ProductsController@openAuction');
Route::get('/category={id}', 'HomeController@byCategory');
