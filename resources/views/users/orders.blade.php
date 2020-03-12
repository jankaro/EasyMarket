@extends('layouts.dashboard')

@section('pageTitle')
    Your orders history
    @endsection
@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Order #</th>
                <th>Title</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>status</th>
                <th>Ordered at</th>

            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->products->product_title}}</td>
                <td>{{$order->products->price}}</td>
                <td>{{$order->products->description}}</td>
                <td>{{$order->products->categories->title}}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->created_at}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endsection
