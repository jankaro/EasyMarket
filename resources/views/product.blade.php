@extends('layouts.homeLayouts.main')



@if($product->is_auction)
    @section('auction-js')
        <script src={{asset('js/jquery-countdown/jquery.countdown.js')}}></script>
      @endsection
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
                            <span class="badge badge-light">
                                <i class="fa fa-store-alt"></i> </span>
                              {{$product->users->name}}
                        </div>
                        <p>{{$product->description}}</p>

                        <hr class="divider">

                        <div class="row mt-3 align-items-center">
                            <div class="col-12">
                                @if($product->is_auction)
                                    <ul class="list-bullet">
                                        <li><strong>Buy now price:</strong> {{$product->auctions->desired_price}} L.E</li>
                                        <li><strong>Auction starting price:</strong> {{$product->auctions->start_price}} L.E</li>
                                        @if($product->auctions->isDue())
                                        <li><strong>Auction ends in:</strong> <span>Ended on {{$product->auctions->end_date}}</span></li>
                                            @else
                                            <li><strong>Auction ends in:</strong> <span data-countdown="{{$product->auctions->end_date}}"></span></li>
                                        @endif
                                    </ul>
                                    @else
                                <span class="price h4">{{$product->price}} L.E</span>
                                    @endif
                            </div> <!-- col.// -->
                            @auth
                            @if(! $product->auctions->isDue())
                                <div class="col-7">
                                    <form method="POST" action="/product/auction={{$product->auctions->id}}">
                                        @csrf
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter bid amount ex. 500" class="form-control" name="value">
                                    </div>
                                </div>
                                <div class="col-5">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Place bid</button>
                                        </div>
                                    </form>
                                </div>
                                    @else
                                @if(!$product->auctions->completeOrder())
                                    <div class="col col-12">
                                            <div class="alert alert-info" role="alert">
                                                Auction has ended already, but there's many auctions still going on
                                            </div>
                                        @endif
                                    @endif
                            @endauth
                            <div class="col col-12">
                                @if(session()->has('message'))
                                <div class="alert alert-{{session()->get('type')}}" role="alert">
                                    {{session()->get('message')}}
                                </div>
                                @endif

                            <div class="table-responsive mt-2">
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($product->auctions->bids->sortByDesc('created_at')->take(3) as $bid)
                                    <tr>
                                        <td width="65">
                                            <img src="{{asset('storage/'.$bid->users->profile_picture)}}" class="img-xs border">
                                        </td>
                                        <td>
                                            <p class="title text-sm-left mb-0"><small>Amount</small> </p>
                                            <var class="price text-muted">{{$bid->value}}</var>
                                        </td>
                                        <td> <small>by:</small> <br>{{$bid->users->name}} </td>
                                        <td width="250"> <p class="text-muted ">{{$bid->created_at}}</p> </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div> <!-- row.// -->

                    </article> <!-- product-info-aside .// -->
                </main> <!-- col.// -->
            </div> <!-- row.// -->
        </div>
        @endsection
    @else
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
                        <span class="badge badge-light">
                                <i class="fa fa-store-alt"></i> </span>
                        {{$product->users->name}}
                    </div>
                    <p>{{$product->description}}</p>

                    <hr class="divider">

                    <div class="row mt-3 align-items-center">
                        <div class="col-4">
                            <span class="price h4">{{$product->price}} L.E</span>
                        </div> <!-- col.// -->
                        <div class="col text-right">
                            <form id="addToCart" action="/cart/add-product={{$product->id}}" method="POST">
                                @csrf
                            <a onclick="document.getElementById('addToCart').submit();" class="btn  btn-primary text-white"> Add to cart <i class="fas fa-shopping-cart"></i>  </a>
                            <a href="#" class="btn  btn-light"> <i class="fas fa-heart"></i>  </a>
                            <a href="#" class="btn  btn-light"> <i class="fa fa-folder-plus"></i>  </a>
                            </form>
                        </div> <!-- col.// -->

                    </div> <!-- row.// -->

                </article> <!-- product-info-aside .// -->
            </main> <!-- col.// -->
        </div> <!-- row.// -->
    </div>
    @endsection
@endif

@section('content2')

    <header class="section-heading">
        @if($product->rates->count() == 0)
            <h3 class="section-title">There's no reviews for this product, so far!</h3>
            <a href="#" class="btn btn-outline-success float-right" data-toggle="modal"
               data-target="#writeReviewModal" >Write a review</a>
        @else
            @auth
        <a href="#" class="btn btn-outline-success float-right" data-toggle="modal"
           data-target="#writeReviewModal" >Write a review</a>
            @endauth
            <a href="#" class="btn btn-outline-primary mr-3 float-right" data-toggle="modal"
               data-target="#reviewsModal" >See all reviews</a>
            <h3 class="section-title">Top reviews</h3>
            @endif
    </header><!-- sect-heading -->

    <div class="row">
        @foreach($product->rates->sortByDesc('rate_value')->take(3) as $rate)
        <div class="col-md-4 mb-3">
            <!-- ============================ COMPONENT ITEM BG ================================= -->
            <span class="badge badge-warning"> <i class="fa fa-star"></i>{{$rate->rate_value}}</span>
            <div class="shadow-sm card-banner">
                <div class="p-4" style="width:75%">
                        <h5 class="card-title">{{$rate->users->name}}</h5>
                    <p>{{substr($rate->feedback, 0 , 30)}} ...</p>
                </div>
                <img src="{{asset('storage/'.$rate->users->profile_picture)}}" height="150" style="border-radius: 50%" class="img-sm align-self-center">
            </div>
            <!-- ============================ COMPONENT ITEM BG  END .// =========================== -->
        </div> <!-- col.// -->
        @endforeach
    </div>

    <hr class="divider">
    <h4 class="section-title">You may also like ...</h4>
    <div class="card card-body">
        <div class="row">
            @foreach(\App\Recommender::similarProducts(\App\Product::all()->toArray(), $product->id, 4) as $similarProduct)
            <div class="col-md-3">
                <figure class="itemside mb-2">
                    <div class="aside"><img src="{{asset('storage/'.$similarProduct['product_picture'])}}" class="border img-sm"></div>
                    <figcaption class="info align-self-center">
                        <a href="/product={{$similarProduct['id']}}" class="title">{{$similarProduct['product_title']}}</a>
                        <strong class="price">{{$similarProduct['price']}} L.E</strong>
                    </figcaption>
                </figure>
            </div> <!-- col.// -->
                @endforeach
        </div> <!-- row.// -->

    </div>

    <!-- reviews modal -->
    <div class="modal fade" id="reviewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All reviews of {{$product->product_title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                @foreach($product->rates->sortByDesc('rate_value') as $rate)

                    <!-- ============================ COMPONENT ITEM BG ================================= -->
                        <span class="badge badge-warning"> <i class="fa fa-star"></i>{{$rate->rate_value}}</span>
                        <div class="shadow-sm card-banner ml-3 mr-3 mb-3">
                            <div class="p-4" style="width:75%">
                                <h5 class="card-title">{{$rate->users->name}}</h5>
                                <p>{{$rate->feedback}}</p>
                            </div>
                            <img src="{{asset('storage/'.$rate->users->profile_picture)}}" height="150" style="border-radius: 50%" class="img-sm align-self-center" >
                        </div>
                        <!-- ============================ COMPONENT ITEM BG  END .// =========================== -->
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- write review modal -->
    <div class="modal fade" id="writeReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Review {{$product->product_title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="/product/review={{$product->id}}">
                        @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <select class="form-control" name="value" required>
                                <option selected disabled>Choose rate</option>
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Good</option>
                                <option value="2">Ok</option>
                                <option value="1">bad</option>
                                <option value="0">Very bad</option>
                            </select>
                        </div>
                        <textarea type="text" name="feedback" placeholder="Please write an honest feedback about the product" class="form-control" required ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" >Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--suppress VueDuplicateTag -->
    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%D days %H:%M:%S'));
                if (event.elapsed){
                    location.reload();
                }
            });
        });
    </script>
    @endsection









