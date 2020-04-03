<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use App\Cart;
use App\Category;
use App\Order;
use App\Product;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        $carts = Auth::user()->carts->where('purchased',false);
        $cart_total=0;
        foreach ($carts as $cartItem){
            $cart_total += $cartItem->price;
        }
       return view('cart', compact('categories', 'cart_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::find($id);

        if ($product->is_auction){

        } elseif ($product->carts->where('purchased',false)->first() == null) {
            $cart = new Cart;
            $cart->user_id = Auth::id();
            $cart->product_id = $product->id;
            $cart->price = $product->price;
            $cart->save();
        } else{

        }

        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $carts = Auth::user()->carts;

        if(Auth::user()->payments == null){
            return redirect()->back()->with(['type'=>'danger','message'=>'Please add payment method before you checkout','action'=>route('profile')]);
        } elseif ($carts->where('purchased',false)->first() != null){
            foreach ($carts as $cart){
                $orders = new Order;
                $orders->product_id = $cart->product_id;
                $orders->user_id = $cart->user_id;
                $orders->seller_id = $cart->products->users->sellers->id;
                $orders->payment_id= $cart->users->payments->id;
                $orders->save();
                $cart->purchased = true;
                $cart->save();
            }
            return redirect()->back()->with(['type'=>'success','message'=>'Your payment is received, please check your orders from here','action'=>route('orders')]);

        }
        return redirect()->back()->with(['type'=>'info','message'=>'Your cart is empty, browse our products','action'=>route('mainPage')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartItem = Cart::destroy($id);

        return redirect()->back();
    }
}
