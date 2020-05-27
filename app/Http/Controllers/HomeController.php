<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   // public function __construct()
  //  {
   //     $this->middleware('auth');
  //  }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();

        return view('homeTest', ['users'=> $users]);
    }

    // Store new Product
    public function store(Request $request)
    {
        Product::create([
            'user_id'=> Auth::id(),
            'product_title' => $request->input('product_title'),
            'price'=> $request->input('price'),
            'description'=> $request->input('description')
        ]);


        return redirect()->action('HomeController@index');
    }

    // fetch and display products by Category
    public function byCategory($id){
        $category= Category::find($id);
        $categories = Category::all();
        return view('category' , compact('category' , 'categories'));
    }

    // Fetch and display Product information
    public function showProduct($id){
        $product = Product::find($id);
        $categories = Category::all();

        return view('product', compact('product','categories'));
    }


}
