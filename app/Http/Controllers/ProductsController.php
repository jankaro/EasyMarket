<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index(){

        $currentUser = User::find(Auth::id());
        $categories = Category::all();

        return view('sellers.addProduct', compact('currentUser','categories'));
    }

    public function addProduct(Request $request, $id){
        $currentUser = User::find($id);
        $product = new Product;
        $product_picture_path = $request->file('product_picture')->store('assets/products_pictures', 'public');

        $product->user_id= $currentUser->id;
        $product->product_title = $request->input('product_title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id= $request->input('category_id');
        $product->product_picture = $product_picture_path;

        $product->save();

        return redirect()->route('seller_products');
    }

    public function updateProduct(Request $request){
        $product_id = $request->input('product_id');
        $update = Product::find($product_id);

        $update->product_title = $request->input('product_title');
        $update->price= $request->input('price');
        $update->description = $request->input('description');
        if ($request->hasFile('product_picture')) {
            $picture_path = $request->file('product_picture')->store('assets/products_pictures', 'public');
            $update->product_picture = $picture_path;
        }
        $update->save();
        return redirect()->route('seller_products');
    }

    public function showOrders(){
        $currentUser= User::find(Auth::id());
        $orders = $currentUser->sellers->orders;

        return view('sellers.ordersManagment', compact('currentUser','orders'));
    }

    public function ChangeOrderStatus(Request $request){
        $order_id=$request->input('order_id');
        $update_order = Order::find($order_id);

        $update_order->status = $request->input('status');
        $update_order->save();

        return redirect()->route('orders_management');
    }
}
