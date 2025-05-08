<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('website.home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('website.reservation.myReservations')}}">Reservations</a>
                </li>
            </ul>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                Logout
            </button>
        </div>
    </div>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('website.logout') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to logout ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if(Session::has('success'))
    <div class="container mt-4">
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded" role="alert">
            <strong><i class="bi bi-check-circle-fill"></i> Success:</strong> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="container">
    <h1> Welcome, {{ Auth::user()->name }}</h1>
    <h2 class="mt-5">Available Services</h2>
    <div class="row">
        @foreach($services as $service)
            @php
                $isReserved = $service->reservations->where('user_id',auth()->id())->count() > 0;
            @endphp
            <div class="col-md-4">
                <div class="card m-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{$service->name}}</h5>
                        <p class="card-text">{{$service->description}}</p>
                        <p><strong>Price:</strong>&nbsp;{{number_format($service->price)}}&nbsp;L.E.</p>
                        @if($isReserved)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{$service->id}}">
                                Cancel Reservation
                            </button>
                        @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveModal{{$service->id}}">
                                Reserve
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="modal fade" id="reserveModal{{$service->id}}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{route('website.reservation.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Reservation date & Time</label>
                                    <input type="datetime-local" name="reservation_time" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Reserve</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="cancelModal{{$service->id}}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{route('website.reservation.cancel',$service->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cancel Reservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to cancel reservation for <strong>{{$service->name}}</strong> ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
