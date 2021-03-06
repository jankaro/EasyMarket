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

//landing page route
Route::get('/', function () {
    $products = Product::where('is_active', true)->get();
    $categories = Category::all();
    return view('home', compact('products','categories'));
})->name('mainPage');

//all products
Route::get('/product', function () {
    return view('pages.productView');
});

// auction products vile
Route::get('/auction', function () {
    return view('pages.auction');
});

//auth routes / login/register/forget password
Auth::routes();

// profile routes
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
// seller auth form
Route::get('/profile/seller/auth', function (){

    $currentUser = User::find(Auth::id());
    $seller_info = $currentUser->sellers;
    return view('sellers.sellerAuth',compact('currentUser', 'seller_info'));
})->name('seller_auth');

Route::post('/profile/seller/auth/submit={id}', 'UserController@sellerAuth');

// seller posted products
Route::get('/profile/seller/products', 'ProductsController@showProducts')->name('seller_products');

// Seller product management
Route::get('/profile/seller/add-product','ProductsController@index')->name('products_index');
Route::post('/profile/seller/add-product={id}', 'ProductsController@addProduct');
Route::get('/profile/seller/manage-orders','ProductsController@showOrders')->name('orders_management');
Route::post('/profile/seller/manage-orders/change','ProductsController@ChangeOrderStatus')->name('change_status');
Route::post('/profile/seller/update-product', 'ProductsController@updateProduct');
Route::post('/profile/seller/open-auction', 'ProductsController@openAuction');

// products auction
Route::get('/profile/seller/auctions', function (){

    $products = Product::where('is_active', true)->get();
    $categories = Category::all();
    return view('home', compact('products','categories'));
});


// cart routes
Route::get('/category={id}', 'HomeController@byCategory');
Route::get('/product={id}', 'HomeController@showProduct');
Route::post('/product/review={id}', 'UserController@SubmitReview');
Route::post('/product/auction={auction_id}', 'ProductsController@placeBid');
Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart={id}', 'CartController@destroy');
Route::post('/cart/add-product={id}', 'CartController@create');
Route::post('/cart/checkout', 'CartController@store');

// Admin routes
Route::get('/admins/dashboard', 'AdminController@index')->name('admins_dashboard');
Route::get('/admins/sellers', 'AdminController@usersIndex')->name('users_index');
Route::post('/admins/sellers/update', 'AdminController@sellerStatus')->name('seller_status');
Route::get('/admins/products', 'AdminController@productsIndex')->name('products_index');
Route::get('/remove-product={product_id}', 'AdminController@removeProduct');
Route::post('/search', 'ProductsController@search');


Route::get('/dev', function (){

    dd(User::find(1)->admins->users);

        return view('test', compact('products'));

});

