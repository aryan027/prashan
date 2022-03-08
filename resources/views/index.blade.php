<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Styles -->

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('/')}}">booking
                        <span class="visually-hidden"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('booking.list') }}">Booking List
                        <span class="visually-hidden"></span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-810">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="card mt-4">
                <div class="card-header">{{ __('Booking List') }}</div>
                <div class="card-body text-center">
                   <table class="table table-striped table-hover">
                       <thead>
                       <tr>
                           <td>S.no</td>
                           <td>Name</td>
                           <td>Email</td>
                           <td>Phone No</td>
                           <td>Booking Date</td>
                           <td>Booking Time</td>
                           <td>Guests</td>
                           <td>Table Number</td>
                           <td>Action</td>
                       </tr>
                       </thead>
                       <tbody>
                        @forelse($bookingList as $key=>$booking )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $booking->first_name.' '.$booking->last_name }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone_no }}</td>
                                <td>{{  date('d-M-Y', strtotime( $booking->booking_date)) }}</td>
                                <td>{{ $booking->booking_time }}</td>
                                <td>{{ $booking->number_of_guests }}</td>
                                <td>{{ $booking->ReservedTable->table_number }}</td>
                                <td>
                                        <a id="delKey{{$key}}" href="#" class="mb-2 mr-2 text-danger btn-hover-shine">Mark Completed</a>

                                    <form action="{{ route('booking.destroy',\Illuminate\Support\Facades\Crypt::encrypt($booking->id)) }}" method="post" id="delNum{{$key}}">
                                        @csrf </form>
                                    <script type="text/javascript">
                                        document.getElementById('delKey{{$key}}').addEventListener('click', function () {
                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: "You won't be able to revert this!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Yes, Completed!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('delNum{{$key}}').submit();
                                                } else {
                                                    swal.fire({
                                                        title: "Action Stopped!",
                                                        text: "Table is Still Occupied!",
                                                        icon: "info",
                                                    })
                                                }
                                            })
                                        });
                                    </script>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-danger text-center"> No Booking Found ...!</td>
                            </tr>
                        @endforelse
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</body>
</html>
