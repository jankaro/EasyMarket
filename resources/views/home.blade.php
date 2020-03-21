@extends('layouts.homeLayouts.main')

@section('content1')
    <header class="section-heading">
        <a href="#" class="btn btn-outline-primary float-right">See all</a>
        <h3 class="section-title">Products for Auction</h3>
    </header><!-- sect-heading -->


    <div class="row">


        @foreach($products->where('is_auction', true) as $product)
        <div class="col-md-3">

            <div href="#" class="card card-product-grid">

                <a href="#" class="img-wrap"> <img src="{{asset('storage/'.$product->product_picture)}}"> </a>
                <figcaption class="info-wrap">
                    <a href="#" class="title">{{$product->product_title}}</a>
                    <div class="rating-wrap">
                        <ul class="rating-stars">
                            <li style="width:80%" class="stars-active">
                                @for($i=0 ;$i < round($product->rate($product->id), 0); $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </li>
                            <li>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                        </ul>
                        <small class="label-rating text-muted">{{$product->rate($product->id)}}/5</small>
                    </div>
                    @if($product->is_auction)
                        <div class="price mt-1">starting from: {{$product->auctions->start_price}} L.E</div> <!-- price-wrap.// -->
                    @else
                        <div class="price mt-1">Price: {{$product->price}} L.E</div> <!-- price-wrap.// -->
                    @endif
                </figcaption>
            </div>
        </div> <!-- col.// -->
            @endforeach
    </div> <!-- row.// -->

    @endsection

@section('content2')
    <header class="section-heading">
        <a href="#" class="btn btn-outline-primary float-right">See all</a>
        <h3 class="section-title">Popular products</h3>
    </header><!-- sect-heading -->


    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3">
            <div href="#" class="card card-product-grid">
                <a href="#" class="img-wrap"> <img src="{{asset('storage/'.$product->product_picture)}}"> </a>
                <figcaption class="info-wrap">
                    <a href="#" class="title">{{$product->product_title}}</a>
                    <div class="rating-wrap">
                        <ul class="rating-stars">
                            <li style="width:80%" class="stars-active">
                                @for($i=0 ;$i < round($product->rate($product->id), 0); $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </li>
                            <li>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                        </ul>
                        <small class="label-rating text-muted">{{$product->rate($product->id)}}/5</small>
                    </div>
                    @if($product->is_auction)
                        <div class="price mt-1">starting from: {{$product->auctions->start_price}} L.E</div> <!-- price-wrap.// -->
                    @else
                        <div class="price mt-1">Price: {{$product->price}} L.E</div> <!-- price-wrap.// -->
                    @endif
                </figcaption>
            </div>
        </div> <!-- col.// -->
        @endforeach
    </div> <!-- row.// -->

@endsection
