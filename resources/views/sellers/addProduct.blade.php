@extends('layouts.dashboard')

@section('pageTitle')
    Add new product
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col col-6 ">
            <form method="POST" action="/profile/seller/add-product={{$currentUser->id}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Product title:</label>
                    <input class="form-control mb-3" name="product_title" type="text" placeholder="Please write a clear name that describe your product">
                    <label>Product Description:</label>
                    <input class="form-control mb-3" name="description" type="text" placeholder="Please enter all the specs of your product">
                    <label>Product Price:</label>
                    <input class="form-control mb-3" name="price" type="text" placeholder="please enter the starting price">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Product category</label>
                        <select class="form-control" name="category_id">
                            <option disabled selected>Please select category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                        </select>
                    </div>
                    <label>Upload picture of the product</label>
                    <input type="file" name="product_picture" class="form-control-file border mb-3">
                    <button type="submit" class="btn btn-success btn-block">Add product</button>
                </div>
            </form>
        </div>
    </div>

@endsection
