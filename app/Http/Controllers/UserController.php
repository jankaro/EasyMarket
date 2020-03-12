<?php

namespace App\Http\Controllers;

use App\Seller;
use App\User;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $currentUser = User::findOrFail(Auth::id());
        $payment_info = $currentUser->payments;

        $isSeller= Seller::firstWhere('user_id',$currentUser->id);


        // return view('pages.usersProfile', ['currentUser' => $currentUser], ['payment_info'=>$payment_info]);

        return view('pages.usersProfile', compact('currentUser', 'payment_info', 'isSeller'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $update = User::find($id);

        $update->name= $request->input('name');
        $update->email= $request->input('email');

        if ($request->input('phone_number')){

            $update->phone_number= $request->input('phone_number');
        }
        if ($request->input('address')){
            $update->address=$request->input('address');
        }
        if ($request->input('password')){
            $update->password=Hash::make($request->input('password'));
        }
        if ($request->hasFile('profile_picture')) {
            $picture_path = $request->file('profile_picture')->store('assets/profile_pictures', 'public');
            $update->profile_picture = $picture_path;
        }

        $update->save();
        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paymentUpdate(Request $request , $id){
        $user = User::find($id);
        $payment_info = $user->payments;

        if (Payment::firstWhere('user_id',$user->id)){

            $this->UpdatePayment($request, $user->id);

        } else {
            $payment_info = new Payment;

            $payment_info->user_id=$user->id;
            $payment_info->card_name = $request->input('card_name');
            $payment_info->card_number = $request->input('card_number');
            $payment_info->expiration_month=$request->input('expiration_month');
            $payment_info->expiration_year=$request->input('expiration_year');
            $payment_info->cvv=$request->input('cvv');
            $payment_info->save();

        }
        return redirect()->action('UserController@index');

    }

    public function sellerAuth(Request $request, $id){
        $currentUser = User::find($id);
        $seller_info = $currentUser->sellers;
        $seller = new Seller;

        $personalPicture_path = $request->file('personal_picture')->store('assets/sellers_documents', 'public');
        $national_id_path = $request->file('national_id')->store('assets/sellers_documents', 'public');

        $seller->user_id= $currentUser->id;
        $seller->seller_name= $request->input('seller_name');
        $seller->personal_picture= $personalPicture_path;
        $seller->national_id= $national_id_path;
        $seller->save();

        $currentUser->is_seller = true;
        $currentUser->save(); // till the configration of sellers approve

        return view('sellers.sellerAuth', compact('currentUser','seller_info'));


    }

    private function UpdatePayment(Request $request, $userID){
        $update = User::find($userID);
        $payment_info = $update->payments;

        $payment_info->card_name = $request->input('card_name');
        $payment_info->card_number = $request->input('card_number');
        $payment_info->expiration_month=$request->input('expiration_month');
        $payment_info->expiration_year=$request->input('expiration_year');
        $payment_info->cvv=$request->input('cvv');
        $payment_info->save();
    }

}
