
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha256-BtbhCIbtfeVWGsqxk1vOHEYXS6qcvQvLMZqjtpWUEx8=" crossorigin="anonymous" />

</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('mainPage')}}">Easy Market</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Admin panel" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('profile')}}">
                            <span data-feather="home"></span>
                            Edit profile <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('orders')}}">
                            <span data-feather="file"></span>
                            Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="shopping-cart"></span>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="users"></span>
                            Payments
                        </a>
                    </li>

                    @if(\Illuminate\Support\Facades\Auth::user()->is_seller)
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Sellers Management</span>
                            <a class="d-flex align-items-center text-muted" href="{{route('seller_auth')}}">
                                <span data-feather="user"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('products_index')}}">
                                    <span data-feather="plus-circle"></span>
                                    Add product
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('seller_products')}}">
                                    <span data-feather="file-text"></span>
                                    My products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('seller_auth')}}">
                                    <span data-feather="file-text"></span>
                                    Seller profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('orders_management')}}">
                                    <span data-feather="edit"></span>
                                    Manage orders
                                </a>
                            </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->admins->exists ?? false)
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Administration section</span>
                                <a class="d-flex align-items-center text-muted" href="{{route('admins_dashboard')}}">
                                    <span data-feather="user"></span>
                                </a>
                            </h6>
                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admins_dashboard')}}">
                                        <span data-feather="home"></span>
                                        Admin Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('products_index')}}">
                                        <span data-feather="home"></span>
                                        Products Management
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('users_index')}}">
                                        <span data-feather="home"></span>
                                        Sellers Management
                                    </a>
                                </li>
                                @endif
                   @yield('sidebarItems')
                </ul>


            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4">@yield('pageTitle')</h1>

                @yield('title_button')
                </div>

                @yield('content')


        </main>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="/js/popper.min.js"></script>
<script src="/js/app.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @yield('sales_array_days'),
            datasets: [{
                label:'Sales EGP',
                data: @yield('sales_array_values'),
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }, {
                label:'Orders #',
                data: @yield('orders_array_values'),
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#450800',
                borderWidth: 4,
                pointBackgroundColor: '#450800'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: true,

            }
        }
    });
</script>

@yield('javascript')

</body>
</html>
