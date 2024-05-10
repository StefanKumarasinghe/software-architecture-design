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

    <!-- Customer Information Form -->
    <div class="jumbotron container-fluid p-3  main-page">
    <div class="my-3 card p-5 shadow col-md-4 bg-dark text-white  rounded-5 mx-auto py-4 mt-5">
    <h1 class="my-3 px-0 mx-auto py-3">Checkout</h1>
    <hr class="bg-white">
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="mx-auto  ">
        @if(is_array($products) && count($products) > 0)
        @foreach($products as $item)
        <div class="row w-100 mx-auto align-items-center border-light rounded-5 my-1 p-3">
                <div class="col-5 text-end"><img class=" rounded-5" style="width:50px; height:50px; object-fit:cover" src="{{ $item['product']->image_url }}"></div>
                
                  <div class="col-6 mx-auto text-start"><strong class="">{{ $item['product']->name }}</strong> x {{ $item['quantity'] }}  </div>
                </div>

        @endforeach
        </div>
        <hr class="bg-white">
        <div class="form-group my-3 text-center mx-auto">
            <label for="special_notes" class="fw-bold text-center my-2 mx-auto" >Special Notes:</label>
            <textarea placeholder="Special request or allergies..." class="p-2 fw-bold form-control text-center" id="special_notes" name="special_notes" rows="3"></textarea>
        </div>
        <div class="form-group my-3 text-center mx-auto">
            <label for="special_notes" class="fw-bold text-center my-2 mx-auto" >Would you like to connect it with a Reservation? Leave Blank if Pickup</label>
            <select name="reservation_id" class="text-center fw-bold form-select">
                                    <option value="">NOW</option>
                                    @foreach($reservations as $reservation)
                                    <option value="{{ $reservation->id }}">{{ $reservation->id }}</option>
                                    @endforeach
            </select>
        </div>
        <p>Choosing a reservation will schedule the order to be prepared later. If you would like to schedule one, create a <a href="{{route('reservation')}}">reservation</a></p>
        <hr class="bg-white">
        <h4 class="my-3 text-danger text-center">Total: AUD {{$total}}</h4>
        <button type="submit" class="btn btn-success fw-bold d-block btn-block p-4 col-12">PAY NOW</button>
        @else
            <p class="fw-bold">You haven't bought anything</p>
        @endif
        </form>
         <hr class="bg-white">
     </div>

    

    </div>
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
</div>
    <footer class="footer mt-auto py-3 bg-dark">
    <div class="container bg-dark text-center text-white">
        <span class="">© 2024 Koala Cafe. All rights reserved.</span>
    </div>
    </footer>
</body>

</html>
