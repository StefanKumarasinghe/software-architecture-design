<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koala Cafe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for Koala Cafe */
        body {
            background-color: #f8f9fa;
            font-family: "Quicksand", sans-serif;
        }

        .navbar {
            background-color: #563d7c;
            position: fixed;
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
        .img-block {
            object-fit:cover;
            height:200px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">Koala Cafe</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('menu')}}">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('reservation')}}">Make Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cart')}}">My Cart</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Customer Information Form -->
    <div class="jumbotron container-fluid main-page">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="">
                    <div class="card-body">
                        <h1 class="my-3">Our Menu</h1>
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ $product->image_url }}" class="img-block card-img-top" alt="{{ $product->name }}">
                                    <div class="card-body">
                                        <h4 class="card-title d-inline fw-bold">{{ $product->name }}</h4> <a class="btn float-end card-text">AUD {{ $product->price }}</a>
                                        <p class="card-text fw-bold">{{ $product->description }}</p>
                                        <form action="{{ route('cart_add') }}" method="POST">
                                            @csrf <!-- CSRF protection -->
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1"> <!-- Assuming quantity is fixed at 1 for now -->
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
