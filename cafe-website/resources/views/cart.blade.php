<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koala Cafe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS for Koala Cafe */
        body {
            background-color: #f8f9fa;
            font-family: "Quicksand", sans-serif;
        }

        .navbar {
            background-color: #563d7c;
      
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
            height: 100vh;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Koala Cafe</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Customer Information Form -->
    <div class="jumbotron container-fluid p-3  main-page">
    <div class="my-3 card p-5 shadow col-md-6 text-center rounded-5 mx-auto py-4 mt-5">
    <h1 class="my-3 px- mx-auto">What's in My Cart?</h1>
    <div class="shadow rounded-5 col-md-6 mx-auto">
    @foreach($products as $item)
        <div class=" my- mx-auto py-3 px-4 col-md-12">
            <strong class="">{{ $item['product']->name }}</strong> x {{ $item['quantity'] }}  
            <form action="{{ route('cart_delete') }}" method="POST" class="d-inline">
            <button type="submit" class="btn text-danger fw-bold  mr- mx-auto"> <strong class="float-end"><span class="material-symbols-outlined">delete</span></strong></button>
                @csrf
                <input type="hidden" name="product" value="{{$item['product']->id}}"> 
            </form>
            </div> 
    @endforeach
    </div >
    <h4 class="my-3 bg-danger mx-auto text-white p-3 col-md-6 my-3 rounded-5 ">Total: AUD {{$total}}</h4>
    <div class="mt-2 mx-auto"><a href="{{route('menu')}}" class="btn btn-warning fw-bold mx-1 d-inline">Keep Ordering</a><a  href="{{route('checkout')}}" class=" d-inline col-md-3 btn btn-success fw-bold">Continue to Checkout</a></div>
    </div>

    

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@ mx-auto.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5. mx-auto/js/bootstrap.min.js"></script>
</body>

</html>
