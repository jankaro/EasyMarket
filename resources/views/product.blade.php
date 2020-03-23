@extends('layouts.homeLayouts.main')

@if($product->is_auction)
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
                            <div class="col-6">
                                @if($product->is_auction)
                                    <ul class="list-bullet">
                                        <li><strong>Buy now price:</strong> {{$product->auctions->desired_price}} L.E</li>
                                        <li><strong>Auction starting price:</strong> {{$product->auctions->start_price}} L.E</li>
                                    </ul>
                                    @else
                                <span class="price h4">{{$product->price}} L.E</span>
                                    @endif
                            </div> <!-- col.// -->
                            <div class="table-responsive mt-5">
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($product->auctions->bids->sortByDesc('created_at')->take(5) as $bid)
                                    <tr>
                                        <td width="65">
                                            <img src="{{asset('storage/'.$bid->users->profile_picture)}}" class="img-xs border">
                                        </td>
                                        <td>
                                            <p class="title mb-0">Bid Amount </p>
                                            <var class="price text-muted">{{$bid->value}}</var>
                                        </td>
                                        <td> by: <br>{{$bid->users->name}} </td>
                                        <td width="250"> <p class="text-muted ">{{$bid->created_at}}</p> </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
@endif

@section('content2')

    <header class="section-heading">
        @if($product->rates->count() == 0)
            <h3 class="section-title">There's no reviews for this product, so far!</h3>
            <a href="#" class="btn btn-outline-success float-right" data-toggle="modal"
               data-target="#writeReviewModal" >Write a review</a>
        @else
        <a href="#" class="btn btn-outline-success float-right" data-toggle="modal"
           data-target="#writeReviewModal" >Write a review</a>
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
                    <p>{{$rate->feedback}}</p>
                </div>
                <img src="{{asset('storage/'.$rate->users->profile_picture)}}" height="150" style="border-radius: 50%" class="img-sm align-self-center">
            </div>
            <!-- ============================ COMPONENT ITEM BG  END .// =========================== -->
        </div> <!-- col.// -->
        @endforeach
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
                            <select class="form-control" name="value">
                                <option selected disabled>Choose rate</option>
                                <option value="5">Excellent</option>
                                <option value="4">Very Good</option>
                                <option value="3">Good</option>
                                <option value="2">Ok</option>
                                <option value="1">bad</option>
                                <option value="0">Very bad</option>
                            </select>
                        </div>
                        <textarea type="text" name="feedback" placeholder="Please write an honest feedback about the product" class="form-control" ></textarea>
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

    @endsection




