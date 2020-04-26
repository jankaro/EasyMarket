@extends('layouts.homeLayouts.main')
@section('title','Easy Market - Shopping Cart')

@section('content1')


    <h5 class="doc-title-sm">Shopping cart</h5>

    <output>
        <div class="row" bis_skin_checked="1">
            <aside class="col-lg-9">

                @if(session()->has('message'))
                    <div class="alert alert-{{session()->get('type')}}" role="alert">
                        <a href="{{session()->get('action')}}">{{session()->get('message')}}</a>
                    </div>
                @endif
                <div class="card" bis_skin_checked="1">

                    <div class="table-responsive" bis_skin_checked="1">

                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Product</th>
                                <th scope="col" width="120">Quantity</th>
                                <th scope="col" width="120">Price</th>
                                <th scope="col" class="text-right d-none d-md-block" width="200"> </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(Auth::user()->carts->where('purchased',false)->first() == null)
                                <td>
                                    <figure class="itemside align-items-center">
                                        <figcaption class="info">
                                            <a href="#" class="title text-dark">Your cart is empty</a>
                                        </figcaption>
                                    </figure>
                                </td>
                            @else
                            @foreach(Auth::user()->carts->where('purchased',false) as $cartIteam)
                            <tr>
                                <td>
                                    <figure class="itemside align-items-center">
                                        <div class="aside" bis_skin_checked="1"><img src="{{asset('storage/'.$cartIteam->products->product_picture)}}" class="img-sm"></div>
                                        <figcaption class="info">
                                            <a href="{{url('/product='.$cartIteam->product_id)}}" class="title text-dark">{{$cartIteam->products->product_title}}</a>
                                            <p class="text-muted small">Category: {{$cartIteam->products->categories->title}} <br> Seller: {{$cartIteam->products->users->name}}</p>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <select disabled class="form-control">
                                        <option>1</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="price-wrap" bis_skin_checked="1">
                                        <var class="price">{{$cartIteam->price}} L.E</var>
                                        <small class="text-muted"> @if($cartIteam->products->is_auction) from auction @endif </small>
                                    </div> <!-- price-wrap .// -->
                                </td>
                                <form id="removeProduct" method="POST" action="/cart={{$cartIteam->id}}">
                                    @csrf
                                <td class="text-right d-none d-md-block">
                                    <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip"> <i class="fa fa-heart"></i></a>
                                    <a onclick="document.getElementById('removeProduct').submit();" class="btn btn-light"> Remove</a>
                                </td>
                                </form>
                            </tr>
                            @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div> <!-- table-responsive.// -->

                    <div class="card-body border-top" bis_skin_checked="1">
                        <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
                    </div> <!-- card-body.// -->

                </div> <!-- card.// -->

            </aside> <!-- col.// -->
            <aside class="col-lg-3">

                <div class="card mb-3" bis_skin_checked="1">
                    <div class="card-body" bis_skin_checked="1">
                        <form>
                            <div class="form-group" bis_skin_checked="1">
                                <label>Have coupon?</label>
                                <div class="input-group" bis_skin_checked="1">
                                    <input type="text" class="form-control" name="" placeholder="Coupon code">
                                    <span class="input-group-append">
				<button class="btn btn-primary">Apply</button>
			</span>
                                </div>
                            </div>
                        </form>
                    </div> <!-- card-body.// -->
                </div> <!-- card.// -->

                <div class="card" bis_skin_checked="1">
                    <div class="card-body" bis_skin_checked="1">
                        <dl class="dlist-align">
                            <dt>Total price:</dt>
                            <dd class="text-right">{{$cart_total}} L.E</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Discount:</dt>
                            <dd class="text-right text-danger"> <small>0.00 L.E </small></dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right text-dark b"><strong>{{$cart_total}} L.E</strong></dd>
                        </dl>
                        <hr>
                        <p class="text-center mb-3">
                            <img src="http://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/misc/payments.png" height="26">
                        </p>
                        <form id="checkout" method="POST" action="/cart/checkout">
                            @csrf
                        <a onclick="document.getElementById('checkout').submit();" class="btn btn-primary btn-block text-white"> Make Purchase </a>
                        <a href="{{route('mainPage')}}" class="btn btn-light btn-block">Continue Shopping</a>
                        </form>
                    </div> <!-- card-body.// -->
                </div> <!-- card.// -->

            </aside> <!-- col.// -->
        </div> <!-- row.// -->
    </output>

@endsection
