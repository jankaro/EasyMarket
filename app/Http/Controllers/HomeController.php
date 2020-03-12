<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();

        return view('home', ['users'=> $users]);
    }

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

}
