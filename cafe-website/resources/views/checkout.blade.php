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

            <div class="collapse float-end navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav float-end ">
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
    <div class="my-3 bg-white p-5 mt-4 text-center  mx-auto shadow rounded-5 col-md-6">
    <h1 class="my-3  py-3">Checkout</h1>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="mx-auto shadow p-3">
        @if(is_array($products) && count($products) > 0)
        @foreach($products as $item)
                  <div class="my-2 mx-auto">
                    <strong class="card-title">{{ $item['product']->name }}</strong> x {{ $item['quantity'] }}   
                   
                </div>
        @endforeach
        </div>
        <div class="form-group my-3">
            <label for="special_notes" class="fw-bold my-2" >Special Notes:</label>
            <textarea class="form-control" id="special_notes" name="special_notes" rows="3"></textarea>
        </div>
        <h4 class="my-3 bg-danger rounded-5 mx-auto text-white p-3">Total: AUD {{$total}}</h4>
        <button type="submit" class="btn btn-success fw-bold d-block btn-block p-4 col-12">PAY NOW</button>
        @else
            <p>You haven't bought anything</p>
        @endif
        </form>
     </div>

    

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
