@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <dl class="row">
                        @foreach($users as $user)
                        <dt class="col-sm-3">{{$user->name}}</dt>
                        @foreach($user->products as $product)
                        <dd class="col-sm-9">{{$product->product_title}}</dd>
                            @endforeach
                        @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add product</div>

                <div class="card-body">


                        <form method="POST" action="/store">
                            @csrf
                            <input type="text" name="product_title" class="form-control m-2" placeholder="Product title">
                            <input type="text"  name="price" class="form-control m-2" placeholder="Product Price">
                            <input type="text"  name="description" class="form-control m-2" placeholder="Product description">
                            <button class="btn btn-primary" type="submit">Add Product</button>
                        </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
