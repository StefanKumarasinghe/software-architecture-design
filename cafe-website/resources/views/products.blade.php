<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koala Cafe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS for Koala Cafe */
        body {
            background-color: #f8f9fa;
            font-family: "Quicksand", sans-serif;
        }

        .navbar {
            background-color: black;

            top: 0;
            width: 100%;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #fff;
        }

        .jumbotron {
            background-image: url('https://static.vecteezy.com/system/resources/previews/026/771/453/large_2x/minimalist-coffee-background-free-photo.jpeg');
            background-attachment: fixed;
            background-size: cover;
            background-color: #f8f9fa;
            padding: 4rem 2rem;
            margin-bottom: 0;
        }

        .card {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .main-page {
            min-height: 100vh;
        }
        .img-block {
            object-fit:cover;
            height:200px;
        }
        #toast {
        position: fixed;
        bottom: 0px;
        text-align:center;
        background-color:green;
        
        margin:10px  ;
        display:block;


        color: white;
        padding: 16px;
        border-radius: 8px;
        z-index: 9999;
        
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg p-3 navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">Koala Cafe</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fw-bold" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('menu')}}">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('reservation')}}">My Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cart')}}">My Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('my_order')}}">My Orders</a>
                    </li>
                </ul>
            </div>
            <a href="" class="btn text-white">@if(session()->has('email')){{ session('email') }}@endif</a>

        </div>
    </nav>
    <div class="bg-primary text-white py-5 px-3 fw-bold">
    <h1 class="my-3 mx-3">Our Menu</h1>
    <p class="my-1 mx-3">We have a collection of things for you to dine at our cafe</p>
    </div>

    <!-- Customer Information Form -->
    <div class="jumbotron container-fluid main-page">

        <div class="row justify-content-center">
            <div class="col-md-10 shadow bg-light p-4 rounded-5">
                <div class="">
                    <div class="card-body">
                       
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow rounded-5">
                                    <img src="{{ $product->image_url }}" class="img-block card-img-top" alt="{{ $product->name }}">
                                    <div class="card-body">
                                        <h4 class="card-title d-inline fw-bold">{{ $product->name }}</h4> <a class="btn float-end fw-bold text-success">AUD {{ $product->price }}</a>
                                        <p class="card-text fw-bold">{{ $product->description }}</p>
                                        <form action="{{ route('cart_add') }}" method="POST">
                                            @csrf <!-- CSRF protection -->
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1"> <!-- Assuming quantity is fixed at 1 for now -->
                                            <button type="submit" class="btn btn-primary d-block m-0 col-12 p-4 fw-bold">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{route('checkout')}}" class="position-fixed rounded-5 bottom-0 end-0 m-3 bg-warning text-dark p-3"><span class="position-absolute bg-danger text-white top-0 end-0 p-1 rounded-5" style="font-size:8px">{{$itemCount}}</span><span class="material-symbols-outlined">shopping_cart</span></a>
    @if(session('success'))
    <div id="toast">
        {{ session('success') }} <span class="fw-bold ms-4" onclick="hideToast()" >x</span>
    </div>
    @endif
    <script>
        function hideToast() {
            document.getElementById('toast').style.display="none"
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></body>
    <footer class="footer mt-auto py-3 bg-dark">
    <div class="container bg-dark text-center text-white">
        <span class="">© 2024 Koala Cafe. All rights reserved.</span>
    </div>
    </footer>
</html>
