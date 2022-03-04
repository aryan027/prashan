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
                                <div class="col-sm-4"> <input type="date" class="form-control" name="Selected_date"></div>
                                <div class="col-sm-4"><input type="time" class="form-control" name="Selected_time"></div>
                                <div class="col-sm-4"><input type="number" class="form-control" name="no_of_person"></div>

                            </div>

                            <div class="row mt-5">
                                <div class="col-sm-3">
                                    <div class="card text-white mb-3" >

                                        <div class="card-body">
                                            <h4 class="card-title text-black">Primary card title</h4>
                                            <p> hello world</p>

                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-lg"> book now</button>
                                </div>
                            </div>
                        </div>

                   </div>
               </div>
           </div>
       </div>

   </body>
</html>
