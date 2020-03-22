@extends('layouts.homeLayouts.main')

@section('content1')

    <div class="card">
        <div class="row no-gutters">
            <aside class="col-sm-6 border-right">
                <article class="gallery-wrap">
                    <div class="img-big-wrap">
                        <a href="{{asset('storage/'.$product->product_picture)}}"><img src="{{asset('storage/'.$product->product_picture)}}"></a>
                    </div> <!-- img-big-wrap.// -->
                </article> <!-- gallery-wrap .end// -->
            </aside>
            <main class="col-sm-6">
                <article class="content-body">
                    <h3 class="title">{{$product->product_title}}</h3>
                    <div class="rating-wrap mb-3">
                        <span class="badge badge-warning"> <i class="fa fa-star"></i>{{$product->rate($product->id)}}</span>
                        <small class="text-muted ml-2">{{$product->rates->count()}} reviews</small>
                    </div>
                    <p>{{$product->description}}</p>

                    <div class="row mt-3 align-items-center">
                        <div class="col-4">
                            <span class="price h4">{{$product->price}} L.E</span>
                        </div> <!-- col.// -->
                        <div class="col text-right">
                            <a href="#" class="btn  btn-primary"> Add to cart <i class="fas fa-shopping-cart"></i>  </a>
                            <a href="#" class="btn  btn-light"> <i class="fas fa-heart"></i>  </a>
                            <a href="#" class="btn  btn-light"> <i class="fa fa-folder-plus"></i>  </a>
                        </div> <!-- col.// -->
                    </div> <!-- row.// -->

                </article> <!-- product-info-aside .// -->
            </main> <!-- col.// -->
        </div> <!-- row.// -->
    </div>

    @endsection

@section('content2')

    <header class="section-heading">
        @if($product->rates->count() == 0)
            <h3 class="section-title">There's no reviews for this product, so far!</h3>
        @else
        <a href="#" class="btn btn-outline-primary float-right">See all</a>
            <h3 class="section-title">Top reviews</h3>
            @endif
    </header><!-- sect-heading -->

    <div class="row">
        @foreach($product->rates as $rate)
        <div class="col-md-4 mb-3">
            <!-- ============================ COMPONENT ITEM BG ================================= -->
            <span class="badge badge-warning"> <i class="fa fa-star"></i>{{$rate->rate_value}}</span>
            <div class="shadow-sm card-banner">
                <div class="p-4" style="width:75%">
                        <h5 class="card-title">{{$rate->users->name}}</h5>
                    <p>{{$rate->feedback}}</p>
                </div>
                <img src="{{asset('storage/'.$rate->users->profile_picture)}}" height="150" class="img-bg">
            </div>
            <!-- ============================ COMPONENT ITEM BG  END .// =========================== -->
        </div> <!-- col.// -->
        @endforeach

    </div>
    @endsection
