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
           min-height:100vh; 
        }

        .img-block {
            object-fit: cover;
            height: 200px;
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
    <!-- Reservation List and Create Form -->
    <div class="jumbotron main-page container-fluid main-page">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="">
                    <div class="card-body">
                        <div class="row mt-5 align-items-center">
                        <div class="col-md-6">
                        <h1 class="my-3 fw-bold">Reservations</h1>
                        <!-- Reservation List -->
                        @forelse($reservations as $reservation)
                            <div>
                                @foreach($reservations as $reservation)
                                    <div>Reservation at {{ $reservation->date_time }}  @if  ($reservation->arrival) <span class="text-success fw-bold"> Arrived </span>@else <span class="text-danger fw-bold"> Pending </span>@endif </div>
                                @endforeach
                            </div>
                        @empty
                            <p>No reservations found.</p>
                        @endforelse
                        <!-- Reservation Form -->
                        </div>
                        <div class="col-md-6 fw-bold mt-4">
                        <!-- Reservation Form -->
                        <h3 class="fw-bold my-3">Create Reservation</h3>
                        <form class="col-md-8" action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="immediate_dining_checkbox" name="immediate_dining">
                                    <label class="form-check-label" for="immediate_dining_checkbox">Is this reservation for immediate dining?</label>
                                </div>
                                <select class="form-control mt-3 rounded-5 p-4 " id="table_id" name="table_id" style="display: none;">
                                    <option value="">Select a Table Available</option>
                                    @foreach($availableTables as $table)
                                        <option value="{{ $table->id }}">{{ $table->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="party_size">For How Many?</label>
                                <input type="number" step="1" max="6" min="1" class="form-control rounded-5 p-4 col-6 my-2" id="party_size" name="party_size" required>
                            </div>
                            <div class="form-group" id="date_id">
                                <label class="mx-auto" for="date_time">For When?</label>
                                <input id="date_time" type="date" class="form-control rounded-5 p-4 mx-a my-2" name="date_time" required>
                            </div>
                            <button type="submit" class="btn btn-primary p-3 fw-bold col-md-12 mt-2">Create Reservation</button>
                        </form>

                        <script>
                            // Toggle table selection based on immediate dining checkbox
                            document.getElementById('immediate_dining_checkbox').addEventListener('change', function() {
                                var tableSelect = document.getElementById('table_id');
                                var dateSelect = document.getElementById('date_id');
                                if (this.checked) {
                                    tableSelect.style.display = 'block';
                                    dateSelect.style.display = 'none'; // Hide the date field
                                } else {
                                    tableSelect.style.display = 'none';
                                    dateSelect.style.display = 'block'; // Show the date field
                                }
                            });
                        </script>
                        <script>
                            // Get the current date
                            var currentDate = new Date();
                            var year = currentDate.getFullYear();
                            var month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Adding 1 because months are zero-based
                            var day = String(currentDate.getDate()).padStart(2, '0');

                            // Format the date as YYYY-MM-DD
                            var minDate = year + '-' + month + '-' + day;

                            // Set the min attribute of the date input to the current date
                            document.getElementById('date_time').setAttribute('min', minDate);
                        </script>


                         </div>
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
