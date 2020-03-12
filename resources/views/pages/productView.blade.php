<!doctype html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
<header>
    @include('layouts.header')
</header>

<main role="main">
    <div class="container my-5 ">
        <div class="row">
            <div class="col-9">
                <h3 class="font-weight-bold">This is a simple product title</h3>
            </div>
            <div class="col-3">
                <h6>Product rate: 3/4</h6>
            </div>
        </div>

        <div class="row">
           <div class="col-auto">
               <img src="https://via.placeholder.com/400x300">
           </div>
            <div class="col">
                <dl class="row">
                    <dt class="col-sm-2">Price</dt>
                    <dd class="col-sm-9"><b>120.0</b> Egyptian Pound</dd>
                    <dt class="col-sm-2">Description</dt>
                    <dd class="col-sm-9">This is an example of a product with a very good price that anyone can afford buying it because it has many features that can benefit many people around the world</dd>
                    <dt class="col-sm-2"></dt>
                    <dd class="col-sm-4">
                        <button type="button" class="btn btn-primary btn-block">Add to Cart</button>
                    </dd>
                    <dd class="col-sm-4">
                        <button type="button" class="btn btn-success btn-block">Buy it now!</button>

                    </dd>
                </dl>
            </div>

        </div>
    </div>



</main>

<footer class="text-muted">
    @include('layouts.footer')
</footer>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/js/app.js" ></script>
</body>
</html>
