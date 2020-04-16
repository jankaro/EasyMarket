@extends('layouts.dashboard')

@section('pageTitle')
    Sellers Management
    @endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Picture</th>
                <th>Name</th>
                <th>Status</th>
                <th>Requested at</th>
                <th>Last Update</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sellers->all() as $seller)
            <tr>
                <td>
                    <img src="{{asset('storage/'.$seller->personal_picture)}}" style="width: 50px; height: 50px; border-radius: 50%; ">
                </td>
                <td>{{$seller->seller_name}}</td>
                <td>{{$seller->status}}</td>
                <td>{{$seller->created_at}}</td>
                <td>{{$seller->updated_at}}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary"
                            data-name="{{$seller->seller_name}}"
                            data-toggle="modal"
                            data-target="#statusModal"
                            data-seller_id="{{$seller->id}}"
                            data-national_id="{{asset('storage/'.$seller->national_id)}}"
                            data-created="{{$seller->created_at}}"
                            data-updated="{{$seller->updated_at}}"
                            data-status="{{$seller->status}}"
                            data-personal_picture="{{asset('storage/'.$seller->personal_picture)}}">
                        <span data-feather="edit"></span>
                    </button>
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
            var button = $(event.relatedTarget); // Button that triggered the modal
            var seller_id = button.data('seller_id');
            var name = button.data('name');
            var status = button.data('status');
            var created = button.data('created');
            var updated = button.data('updated');
            var national_id = button.data('national_id');
            var personal_picture = button.data('personal_picture');
            // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
           modal.find('.modal-title').text('Change Status of '+ name);
           modal.find('#seller_id').text('#'+ seller_id);
           modal.find('#seller_id_form').val(seller_id);
           modal.find('#name').text( name);
           modal.find('#status').text( status);
           modal.find('#created').text('Requested at: '+created);
           modal.find('#updated').text('Updated at: '+updated);
           modal.find('#personal_picture').attr('src',personal_picture);
           modal.find('#national_id').attr('src',national_id);
        })
    </script>

@endsection




<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col ">
                        <img id="personal_picture" src="#" style="width: 150px; height: 150px;" >
                    </div>
                    <div class="col">
                        <img id="national_id" src="#" style="width: 280px; height: 150px;">
                    </div>
                </div>
                <div class="form-group text-center">
                    <p class="col-form-label" id="seller_id" ></p>
                    <p class="col-form-label" id="name" ></p>
                    <p class="col-form-label" id="status"></p>
                </div>
                <div class="form-group">
                    <h6 id="created"></h6>
                    <h6 id="updated"></h6>
                </div>


                <form action="/admins/sellers/update" method="POST">
                    @csrf
                    <div class="form-group">
                        <input id="seller_id_form" name="sellerID" type="hidden">
                        <label class="col-form-label">Change status to:</label>
                        <select class="form-control" name="status">
                            <option disabled selected>Please select status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
