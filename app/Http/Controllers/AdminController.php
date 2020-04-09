<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    protected $orders;
    protected $products;
    protected $sellers;
    public function __construct()
    {

        $this->orders = new Order();
        $this->products= new Product();
        $this->sellers = new Seller;
    }


    public function index(){

        return view('admins.dashboard')->with(['orders'=>$this->orders, 'products'=>$this->products, 'sellers'=>$this->sellers]);
    }
}
