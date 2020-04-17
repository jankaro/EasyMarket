@extends('layouts.dashboard')

@section('sidebarItems')

        @endsection

@section('pageTitle')

    Seller's Authentication form
    @if($currentUser->sellers == null)
        <h6>Please fill the required information to be authenticated</h6>
    @elseif($currentUser->sellers->status === 'approved')
    <h6>You can now start posting products! Good Luck</h6>
    @else
        <h6>Your information is being reviewed by Easy Market team, you can't edit your information at this stage</h6>
    @endif
@endsection

@if($currentUser->sellers == null)
@section('content')
    <div class="row justify-content-center">
        <div class="col col-6 ">
            <form method="POST" action="/profile/seller/auth/submit={{$currentUser->id}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Full-name:</label>
                    <input class="form-control mb-3" name="seller_name" type="text" placeholder="Please write your full-name as in your id">
                    <label>Select your personal picture</label>
                    <input type="file" name="personal_picture" class="form-control-file border mb-3">
                    <label>Select clear scan of your national id</label>
                    <input type="file" name="national_id" class="form-control-file border mb-3">
                    <button type="submit" class="btn btn-success btn-block">Submit my documents</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
@else
@section('content')
    <div class="row justify-content-center">
        <div class="row">
        <div class="col-md-3">
            <label>Personal picture</label>
            <img src="{{asset('storage/'.$seller_info->personal_picture)}}" style="width: 200px; height: 200px;  margin-right: 20px;">

        </div>
        <div class="col col-6">
            <label>Your national id</label>
            <img src="{{asset('storage/'.$seller_info->national_id)}}" style="width: 400px; height: 200px;  margin-right: 20px;">
        </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col col-8">
            <div class="form-group">
                <label>Full-name:</label>
                <input class="form-control mb-3" name="seller_name" type="text" value="{{$seller_info->seller_name}}" disabled >
                <label>Seller id</label>
                <input type="text" name="seller_id" class="form-control mb-3" value="{{$seller_info->id }}" disabled>
                <h5 class="text-capitalize"><strong>Status:</strong> {{$seller_info->status}}</h5>
            </div>
        </div>
    </div>

@endsection

@endif
