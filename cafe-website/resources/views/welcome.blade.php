<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koala Cafe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS for Koala Cafe */
        body {
            background-color: #f8f9fa;
            font-family: "Quicksand", sans-serif;
        }
        .navbar {
            background-color: black;
            position:fixed;
            top:0;
            width:100%;
        }
        .navbar-brand,
        .navbar-nav .nav-link {
            color: #fff;
        }
        .jumbotron {
            background-image:url('https://static.vecteezy.com/system/resources/previews/026/771/453/large_2x/minimalist-coffee-background-free-photo.jpeg');
            background-size:cover;
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

            height:100vh;
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
    <div class="jumbotron d-flex main-page justify-content-center align-items-center">
        <div class="container ">
            <h1 class="fw-bold">Welcome to Koala Cafe</h1>
            <p class="fw-bold">Enjoy delicious food and drinks in a cozy atmosphere.</p>
            
            <p>"We specialize in providing high-quality meals using fresh ingredients."</p>
            <a class="btn btn-primary btn-lg me-1 fw-bold" href="{{route('start_order')}}" role="button">Order Now</a><a class="btn btn-danger btn-lg fw-bold" href="{{route('reservation')}}" role="button">Reservations</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <footer class="footer mt-auto py-3 bg-dark">
    <div class="container bg-dark text-center text-white">
        <span class="">© 2024 Koala Cafe. All rights reserved.</span>
    </div>
</footer>

</body>

</html>
