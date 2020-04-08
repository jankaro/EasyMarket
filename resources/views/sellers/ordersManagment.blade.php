@extends('layouts.dashboard')

@section('pageTitle')

    My product's orders
@endsection

@section('content')
    <div class="table-responsive-sm">
        <table class="table table-striped table-sm table-hover">
            <thead>
            <tr>
                <th>Order #</th>
                <th>Title</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>status</th>
                <th>Ordered at</th>
                <th>Action</th>
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
                    <td>{{$order->products->description}}</td>
                    <td>{{$order->products->categories->title}}</td>
                    <td>{{$order->status}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <div class="row">
                            <div class="col-1 d-flex">
                                <button type="button" class="btn btn-sm btn-primary"
                                        data-title="{{$order->products->product_title}}"
                                        data-toggle="modal"
                                        data-target="#statusModal"
                                        data-orderId="{{$order->id}}">
                                    <span data-feather="edit"></span>
                                    </button>
                            </div>
                        </div>
                    </td>
                </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('javascript')

    <script>

        $('#statusModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var order_id = button.data('orderid')
            var title = button.data('title')
            // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#order_id').text('Order ID: '+order_id)
            modal.find('#title').text('Product title: '+title)
            modal.find('#display_id').val(order_id)
            modal.find('.modal-title ').text('Change status of order #'+order_id)
        })
    </script>

    @endsection

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update order #{{$order->id ?? ''}} status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <h6 class="col-form-label" id="order_id" ></h6>
                    </div>
                    <div class="form-group">
                        <h6 class="col-form-label" id="title"></h6>
                    </div>

                <form action="/profile/seller/manage-orders/change" method="POST">
                    @csrf
                    <div class="form-group">
                        <input id="display_id" name="order_id" type="hidden">
                        <label class="col-form-label">Change status to:</label>
                        <select class="form-control" name="status">
                            <option disabled selected>Please select status</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="returned">Returned</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Change status</button>
            </div>
            </form>
        </div>
    </div>
</div>



