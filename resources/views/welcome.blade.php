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
                                <div class="col-sm-3"><input type="time" class="form-control" name="Selected_time" id="InputTime"></div>
                                <div class="col-sm-3"><input type="number" class="form-control" name="no_of_person" id="InputGuest"></div>
                                <div class="col-sm-2">   <button type="button" class="btn btn-primary" id="BookNowBTN">
                                        Search
                                    </button></div>

                            </div>

                        </div>
                   </div>
                   <div class="container" id="TablesResult"></div>

               </div>
           </div>
       </div>
       <!-- Vertically centered modal -->

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

               $(document).on('click', '.booking-reference-button', function () {
                   const dateVal = $('#InputDate').val();
                   const timeVal = $('#InputTime').val();
                   var TableID = $(this).attr('tableID');
                   $('#TableTarget').val(TableID);
                   $('#selected_date').val(dateVal);
                   $('#selected_time').val(timeVal);
                   $('#DateInput').val(dateVal);
                   $('#TimeInput').val(timeVal);
               });
           });
       </script>

   </body>
</html>
