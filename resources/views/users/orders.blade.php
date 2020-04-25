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
            @foreach($orders->sortByDesc('created_at') as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->products->product_title}}</td>
                @if($order->products->is_auction)
                    <td>{{$order->products->auctions->current_price}}</td>
                @else
                    <td>{{$order->products->price}}</td>
                @endif
                <td>{{substr($order->products->description,0,30)}} ...</td>
                <td>{{$order->products->categories->title}}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->created_at}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endsection
