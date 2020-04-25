@extends('layouts.dashboard')

@section('pageTitle')

    My posted products
    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addProduct" >Add new</button>
@endsection

@section('content')
    @if(session()->has('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session()->get('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="table-responsive-sm">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Picture</th>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @if(null != $products_info->first())
            @foreach($products_info->sortByDesc('created_at') as $product)
                <tr>
                    <td>
                        <img src="{{asset('storage/'.$product->product_picture)}}" style="width: 50px; height: 50px; border-radius: 50%; ">
                    </td>
                    <td>{{$product->id}}</td>
                    <td>{{$product->product_title}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{substr($product->description,0,30)}} ...</td>
                    <td>{{$product->categories->title}}</td>
                    <td>
                        @if($product->is_active)
                            Active
                        @else
                            Not active
                        @endif
                    </td>
                    <td>{{$product->created_at}}</td>
                    <td>
                        <div class="row">
                            <div class="col-1 d-flex">
                                <a class="d-flex align-items-center text-muted" data-toggle="modal"
                                   data-product_id="{{$product->id}}"
                                   data-product_title="{{$product->product_title}}"
                                   data-product_price="{{$product->price}}"
                                   data-product_description="{{$product->description}}"
                                   data-target="#productModal" href="">
                                    <span data-feather="edit"></span>
                                </a>
                            </div>
                            @if($product->is_auction == false)
                            <div class="col-1 d-flex">
                                <a class="d-flex align-items-center text-muted" data-toggle="modal"
                                   data-target="#addAuctionModal"
                                   data-product_id="{{$product->id}}" href="">
                                    <span data-feather="plus-circle"></span>
                                </a>
                            </div>
                                @else
                                <div class="col-1 d-flex">
                                    <a class="d-flex align-items-center text-muted"  target="_blank" href="/product={{$product->id}}">
                                        <span data-feather="link"></span>
                                    </a>
                                </div>
                                @endif
                        </div>
                    </td>
                </tr>
            @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('javascript')

    <script>

        $('#productModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var product_id = button.data('product_id')
            var product_title = button.data('product_title')
            var product_price = button.data('product_price')
            var product_description = button.data('product_description')

            // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#product_id').val(product_id)
            modal.find('#product_title').val(product_title)
            modal.find('#price').val(product_price)
            modal.find('#description').text(product_description)
        })

        $('#addAuctionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var product_id = button.data('product_id')

            var modal = $(this)
            modal.find('#product_id').val(product_id)
        })
    </script>

@endsection

@if($products_info->first() != null)
    <!-- update product modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update product information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/profile/seller/update-product" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="product_id" name="product_id">
                        <div class="form-group">
                            <label>Product title:</label>
                            <input class="form-control mb-3" id="product_title" name="product_title" type="text" value="{{$product->product_title}} " required>
                            <label>Product Description:</label>
                            <textarea class="form-control mb-3" id="description" name="description" type="text" required></textarea>
                            <label>Product Price:</label>
                            <input class="form-control mb-3" id="price" name="price" type="text" value="{{$product->description}}" required>
                            <label>change picture of the product</label>
                            <input type="file" name="product_picture" class="form-control-file border mb-3">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endif

    <!-- add product modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/profile/seller/add-product={{$currentUser->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Product title:</label>
                            <input class="form-control mb-3" name="product_title" type="text" placeholder="Please write a clear name that describe your product" required>
                            <label>Product Description:</label>
                            <textarea class="form-control mb-3" name="description" type="text" placeholder="Please enter all the specs of your product" required></textarea>
                            <label>Product Price:</label>
                            <input class="form-control mb-3" name="price" type="text" placeholder="please enter the starting price" required>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Product category</label>
                                <select class="form-control" name="category_id" required>
                                    <option disabled selected>Please select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label>Upload picture of the product</label>
                            <input type="file" name="product_picture" class="form-control-file border mb-3" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



<!-- Add auction modal -->
<div class="modal fade" id="addAuctionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Open auction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/profile/seller/open-auction">
                    @csrf
                    <input type="hidden" id="product_id" name="product_id">
                    <div class="form-group">
                        <label>Starting Price:</label>
                        <input class="form-control mb-3" id="start_price" name="start_price" type="text" required>
                        <label>Buy Now Price:</label>
                        <input class="form-control mb-3" id="desired_price" name="desired_price" type="text" required>
                        <label>Auction End-Date:</label>
                        <input class="form-control mb-3" id="end_date" name="end_date" type="datetime-local" required>
                        <label class="form-check-label text-muted">* All prices must be in Egyptian Pound</label>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" required>
                            <label class="form-check-label"  for="exampleCheck1">I, Agree that once a product is open for auction it cannot be cancelled.</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Open Auction</button>
            </div>
            </form>
        </div>
    </div>
</div>
