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

    public function usersIndex(){

        return view('admins.usersMgmt')->with(['sellers'=>$this->sellers]);
    }

    public function sellerStatus(Request $request){
        $seller = Seller::find($request->input('sellerID'));
        if ($request->input('status') === 'approved'){
            $seller->status = $request->input('status');
            $seller->save();
            $seller->users->is_seller=true;
            $seller->users->save();
        } elseif ($request->input('status') === 'pending' || $request->input('status') === 'deactivated'){
            $seller->status = $request->input('status');
            $seller->save();
            $seller->users->is_seller=false;
            $seller->users->save();
        }else{
            $seller->status = $request->input('status');
            $seller->save();
            $seller->users->is_seller=false;
            $seller->users->save();
            $seller->destroy($seller->id);
        }

        return redirect()->back();
    }
}
