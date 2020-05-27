@extends('layouts.dashboard')

@section('pageTitle')

    Products Management
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
                        <td>{{ substr($product->product_title,0,40)}}...</td>
                        <td>{{$product->price}}</td>
                        <td>{{substr($product->description,0,30)}}...</td>
                        <td>{{$product->categories->title}}</td>
                        <td>
                            @if($product->is_active)
                                Active
                            @else
                                Not active
                            @endif
                        </td>
                        <td>{{substr(\Carbon\Carbon::parse($product->created_at)->toDayDateTimeString(),0,30)}}</td>
                        <td>
                            <div class="row">
                                <div class="col-1 d-flex">
                                    <button type="button" class="btn btn-sm btn-primary"
                                            data-toggle="modal"
                                            data-product_id="{{$product->id}}"
                                            data-product_title="{{$product->product_title}}"
                                            data-product_price="{{$product->price}}"
                                            data-product_description="{{$product->description }}"
                                            data-status="{{$product->is_active}}"
                                            data-image="{{asset('storage/'.$product->product_picture)}}"
                                            data-target="#productModal">
                                        <span data-feather="edit"></span>
                                    </button>
                                </div>
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
            var status = button.data('status')
            var image = button.data('image')

            // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#product_id').val(product_id)
            modal.find('#product_title').val(product_title)
            modal.find('#price').val(product_price)
            modal.find('#description').text(product_description)
            modal.find('#product_image').attr('src', image)
            modal.find('#deleteProduct').attr('href','/remove-product='+product_id)
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
                        <div class="row text-center">
                            <div class="col img-wrap">
                                <img id="product_image" src="#" style="width: 300px; height: 200px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Product title:</label>
                            <input class="form-control mb-3" id="product_title" name="product_title" type="text" value="">
                            <label>Product Description:</label>
                            <textarea class="form-control mb-3" id="description" name="description" type="text"></textarea>
                            <label>Product Price:</label>
                            <input class="form-control mb-3" id="price" name="price" type="text" value="">
                            <label>change picture of the product:</label>
                            <input type="file" name="product_picture" class="form-control-file border mb-3">
                            <label>Status:</label>
                            <select class="form-control" name="status">
                                <option disabled selected>Please select status</option>
                                <option value="1">Approve</option>
                                <option value="0">Reject</option>
                            </select>
                        </div>
                        <h6 class="text-center text-danger"><a id='deleteProduct' href="#"> Delete this product</a></h6>

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


