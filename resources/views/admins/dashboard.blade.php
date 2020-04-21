@extends('layouts.dashboard')

@section('pageTitle')
    Easy Market Administration Dashboard
@endsection

@section('content')

    <div class="row">
        <div class="col mb-4">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header text-center"><i class="fa fa-dollar-sign"></i> Total sales</div>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        {{$orders->total_sales()}} L.E
                    </h5>
                </div>
            </div>
            </div>
        <div class="col mb-4">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header text-center"><i class="fa fa-store"></i> Today's orders</div>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        {{$orders->whereDate('created_at','>=', \Carbon\Carbon::today()->toDateString())->count()}} Orders
                    </h5>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header text-center"><i class="fa fa-box-open"></i> Pending Products</div>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        {{$products->where('is_active', false)->count()}} Product
                    </h5>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header text-center"><i class="fa fa-user"></i> Pending Sellers</div>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        {{$sellers->where('status', 'pending')->count()}} Request
                    </h5>
                </div>
            </div>
        </div>
        </div>
    <h1 class="h5 text-center">Last week Sales & Orders</h1>
    <div class="row justify-content-center">
        <div class="col-9">
            <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
        </div>
    </div>


    @endsection



@section('sales_array_days')
    ["{{\Carbon\Carbon::today()->subDays(6)->dayName}}",
    "{{\Carbon\Carbon::today()->subDays(5)->dayName}}",
    "{{\Carbon\Carbon::today()->subDays(4)->dayName}}",
    "{{\Carbon\Carbon::today()->subDays(3)->dayName}}",
    "{{\Carbon\Carbon::today()->subDays(2)->dayName}}",
    "{{\Carbon\Carbon::today()->subDays(1)->dayName}}",
    "{{\Carbon\Carbon::today()->subDays(0)->dayName}}"]
    @endsection

@section('sales_array_values')
    [{{$orders->total_sales_chart($orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(6)->toDateString())->get())}},
    {{$orders->total_sales_chart($orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(5)->toDateString())->get())}},
    {{$orders->total_sales_chart($orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(4)->toDateString())->get())}},
    {{$orders->total_sales_chart($orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(3)->toDateString())->get())}},
    {{$orders->total_sales_chart($orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(2)->toDateString())->get())}},
    {{$orders->total_sales_chart($orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(1)->toDateString())->get())}},
    {{$orders->total_sales_chart($orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(0)->toDateString())->get())}}]
@endsection
@section('orders_array_values')
    [{{$orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(6)->toDateString())->count()}},
    {{$orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(5)->toDateString())->count()}},
    {{$orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(4)->toDateString())->count()}},
    {{$orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(3)->toDateString())->count()}},
    {{$orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(2)->toDateString())->count()}},
    {{$orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(1)->toDateString())->count()}},
    {{$orders->whereDate('created_at','=', \Carbon\Carbon::today()->subDays(0)->toDateString())->count()}}]
@endsection

