<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
                           <a class="nav-link active" href="#">Home
                               <span class="visually-hidden">(current)</span>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="#">Features</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="#">Pricing</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="#">About</a>
                       </li>
                       <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                           <div class="dropdown-menu">
                               <a class="dropdown-item" href="#">Action</a>
                               <a class="dropdown-item" href="#">Another action</a>
                               <a class="dropdown-item" href="#">Something else here</a>
                               <div class="dropdown-divider"></div>
                               <a class="dropdown-item" href="#">Separated link</a>
                           </div>
                       </li>
                   </ul>
                   <form class="d-flex">
                       <input class="form-control me-sm-2" type="text" placeholder="Search">
                       <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                   </form>
               </div>
           </div>
       </nav>
       <div class="container">
           <div class="row justify-content-center">
               <div class="col-md-8">
                   <div class="card mt-4">
                       <div class="card-header">{{ __('Pizza Zone Online Reservation System') }}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4"> <input type="date" class="form-control" name="Selected_date" id="InputDate"></div>
                                <div class="col-sm-4"><input type="time" class="form-control" name="Selected_time" id="InputTime"></div>
                                <div class="col-sm-4"><input type="number" class="form-control" name="no_of_person" id="InputGuest"></div>
                                <br>
                                <div class="container" id="TablesResult"></div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-primary" id="BookNowBTN">
                                       BookNow
                                    </button>
                                </div>
                            </div>
                        </div>

                   </div>
               </div>
           </div>
       </div>
       <!-- Vertically centered modal -->
       <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <div class="row">
                           <div class="col-sm-6">
                               <div class="mb-3">
                                   <label for="selected_date" class="form-label">Date</label>
                                   <input type="text" name="selected_date" class="form-control-plaintext" id="selected_date" >
                               </div>
                           </div>
                           <div class="col-sm-6">
                               <div class="mb-3">
                                   <label for="selected_time" class="form-label">Time</label>
                                   <input type="text" name="selected_time" class="form-control-plaintext" id="selected_time" >
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-6">
                               <div class="mb-3">
                                   <label for="first_name" class="form-label">First Name</label>
                                   <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter the first name">
                               </div>
                           </div>
                           <div class="col-sm-6">
                               <div class="mb-3">
                                   <label for="last_name" class="form-label">Last Name</label>
                                   <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter your last name">
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-6">
                               <div class="mb-3">
                                   <label for="email" class="form-label">Email address</label>
                                   <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                               </div>
                           </div>
                           <div class="col-sm-6">
                               <div class="mb-3">
                                   <label for="phone_no" class="form-label">Phone No.</label>
                                   <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Enter you number">
                               </div>
                           </div>
                       </div>

                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                       <button type="button" class="btn btn-primary">Save changes</button>
                   </div>
               </div>
           </div>
       </div>
       @php $tables = Session::get('tables') @endphp
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
       <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
       <script type="text/javascript">
           const LoadTables = <?=json_encode(route('list.tables')) ?>;
           const URL = '{{ route('booking') }}';
           $(document).ready(function () {
               $(document).on('click', '#BookNowBTN', function () {
                   const dateVal = $('#InputDate').val();
                   const timeVal = $('#InputTime').val();
                   const guestVal = $('#InputGuest').val();

                   $.ajax({
                       url: URL,
                       type: 'POST',
                       data: {
                           _token: '{{ @csrf_token() }}',
                           date: dateVal,
                           time: timeVal,
                           guest: guestVal
                       },
                       success: function (response) {
                           if (response.status == true) {
                               $("#TablesResult").empty();
                               $("#TablesResult").load(LoadTables);
                           } else {
                               $("#TablesResult").empty();
                               alert(response.message);
                           }
                       },
                       error: function () {
                           $("#TablesResult").empty();
                       }
                   });
               });
           });
       </script>

   </body>
</html>
