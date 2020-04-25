@extends('layouts.dashboard')

@section('sidebarItems')

    @endsection
@section('pageTitle')
    My Profile
    @endsection

@if(!$currentUser->is_seller)
@section('title_button')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a href="/profile/seller/auth">Want to be a seller? Apply now!</a>
        </div>
    </div>
    @endsection
@endif



@section('content')

    <div class="row">
        <div class="col-md-3">
            <img src="{{asset('storage/'.$currentUser->profile_picture)}}" style="width: 150px; height: 150px; border-radius: 50%;  margin-right: 20px;">
        </div>
        <div class="col-md-5 mt-3">
            <form method="POST" action="/profile/update/{{$currentUser->id}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name:</label>
                    <input class="form-control mb-3" name="name" type="text" value="{{$currentUser->name}}" required>
                    <label>Email:</label>
                    <input class="form-control mb-3" name="email" type="email" value="{{$currentUser->email}}" required>
                    <label>Mobile number:</label>
                    <input class="form-control mb-3" name="phone_number" type="text" value="{{$currentUser->phone_number}}" required placeholder='Please enter your mobile number'>
                    <label>Address:</label>
                    <input class="form-control mb-3" name="address" type="text" value="{{$currentUser->address}}" placeholder="Please enter your address" required>
                    <label>Password:</label>
                    <input class="form-control mb-3" name="password" type="password" placeholder="Write your new password here, if you wish to change it">
                    <label>Upload new profile picture:</label>
                    <input type="file" name="profile_picture" class="form-control-file border mb-3" required>
                    <button type="submit" class="btn btn-success btn-block">save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Payment method</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col col-6 ">
            <form method="POST" action="/profile/update/payment/{{$currentUser->id}}">
                @csrf
                <div class="form-group">
                    <label>Name on card:</label>
                    <input class="form-control mb-3" name="card_name" type="text" value="{{$payment_info->card_name ?? ''}}" required>
                    <label>Card Number:</label>
                    <input class="form-control mb-3" name="card_number" type="text" value="{{$payment_info->card_number ?? ''}}" required>
                    <label>Expiration month:</label>
                    <input class="form-control mb-3" name="expiration_month" type="text" value="{{$payment_info->expiration_month ?? ''}}" placeholder='expiration month' required>
                    <label>Expiration year:</label>
                    <input class="form-control mb-3" name="expiration_year" type="text" value="{{$payment_info->expiration_year ?? ''}}" placeholder="expiration year" required>
                    <label>Security code (CVV):</label>
                    <input class="form-control mb-3" name="cvv" type="password" placeholder="Write your new cvv here, if you wish to change it" required>
                    <button type="submit" class="btn btn-success btn-block">@if(isset($payment_info->cvv)) Save changes @else Add Card @endif</button>
                </div>
            </form>
        </div>
    </div>




    @endsection


