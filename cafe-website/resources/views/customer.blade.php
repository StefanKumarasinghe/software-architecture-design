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
                </ul>
            </div>
            <a href="" class="btn text-white">@if(session()->has('email')){{ session('email') }}@endif</a>

        </div>
    </nav>

    <!-- Customer Information Form -->
    <div class="jumbotron container-fluid ">

    <div class="row justify-content-center">
        <div class="col-md-4 p-3 shadow bg-white rounded-5">
            <div class="">
                <div class="card-body text-center  fw-bold rounded-5">
                    <h1 class="my-4">Quick Auth</h1>
                    <form action="{{ route('create_customer') }}" method="POST">
                        @csrf
                        <div class="form-group my-2">
                            <label for="first_name" class="my-1">First Name</label>
                            <input type="text" class="form-control p-4 rounded-5  @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="last_name" class="my-1">Last Name</label>
                            <input type="text" class="form-control  p-4 rounded-5  @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="email" class="my-1">Email</label>
                            <input type="email" class="form-control p-4 rounded-5 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="email" class="my-1" >Address</label>
                            <input type="text" class="form-control p-4 rounded-5  @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" >
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="phone" class="my-1">Phone</label>
                            <input type="tel" class="form-control p-4 rounded-5  @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success fw-bold p-4 col-12 d-block">Start Ordering</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @if(session('error'))
    <div id="toast" class="bg-danger text-white">
        {{ session('error') }} <span class="fw-bold ms-4" onclick="hideToast()" >x</span>
    </div>
    @endif
    <script>
        function hideToast() {
            document.getElementById('toast').style.display="none"
        }
    </script>

    <footer class="footer mt-auto py-3 bg-dark">
    <div class="container bg-dark text-center text-white">
        <span class="">© 2024 Koala Cafe. All rights reserved.</span>
    </div>
    </footer>
</body>

</html>
