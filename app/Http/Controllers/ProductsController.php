<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use App\Category;
use App\Order;
use App\Product;
use App\Recommender;
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

    public function showProducts(){
        $currentUser = User::find(Auth::id());
        $products_info = $currentUser->products;
        $categories = Category::all();

        return view('sellers.myProducts',compact('currentUser', 'products_info','categories'));
    }

    public function addProduct(Request $request, $id){
        $currentUser = User::find($id);
        $product = new Product;


        $product->user_id= $currentUser->id;
        $product->product_title = $request->input('product_title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id= $request->input('category_id');
        if ($request->hasFile('product_picture')) {
            $product_picture_path = $request->file('product_picture')->store('assets/products_pictures', 'public');
            $product->product_picture = $product_picture_path;
        }
        $product->save();
        Recommender::updateSimilarityMatrix();
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
        if ($request->input('status') == 1){
            $update->is_active = true;
        } elseif ($request->input('status') == 0) {
            $update->is_active = false;
        }
        $update->save();
        Recommender::updateSimilarityMatrix();
        return redirect()->back();
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

    public function openAuction(Request $request){
        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        $user = User::find(Auth::id());

        $auction = new Auction;
        $auction->user_id = $user->id;
        $auction->product_id = $product->id;
        $auction->start_price = $request->input('start_price');
        $auction->desired_price = $request->input('desired_price');
        $auction->end_date = $request->input('end_date');

        if ($product->is_auction == true){
            return redirect()->back()->with('status', 'Your product is already in auction');
        } elseif($auction->save()) {
            $product->is_auction = true;
            $product->save();
            return redirect()->back()->with('status', 'Your product '.$product->product_title.' is open now for auction');
        }else{
            redirect()->back()->with('status', 'Something is wrong, Please try again or contact our support team');
        }

    }

    public function placeBid(Request $request, $auction_id){
        $auction= Auction::find($auction_id);
        $value = $request->input('value');
        if ( !($value >= $auction->start_price && $value > $auction->current_price) ){
            return redirect()->back()->with(['type'=>'danger', 'message'=>'You cannot bid with this amount as its less than the current price']);
        } elseif (User::find(Auth::id())->payments != null){

            $bid = new Bid;
            $bid->user_id= Auth::id();
            $bid->auction_id = $auction_id;
            $bid->value=$value;
           if ($bid->save()){
              $auction->current_price = $value;
              $auction->save();
           }
            return redirect()->back();

        }else {
             return redirect()->back()->with(['type'=>'info', 'message'=>'You have to add payment method from your profile first!']);
        }


    }
}
