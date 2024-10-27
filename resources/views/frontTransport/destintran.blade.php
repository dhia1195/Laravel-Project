<x-layouts.base>
    {{-- Include the existing navbar --}}
    @include('layouts.navbars.guest.login') <!-- Adjust the path if needed -->

    <!doctype html>
    <html lang="en">
    <head>
        <title>{{ $destination->name }} - Travel Trek</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!-- Fonts and icons -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <link href="assets/css/material-kit.css?v=3.0.0" rel="stylesheet" />
    </head>

    <body>
        <!-- Navbar Transparent -->
        <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent">
            <div class="container">
                <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon mt-2">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="page-header min-vh-80" style="background-image: url('{{ $destination->background_image_url }}')">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="text-center">
                            <h1 class="text-white font-weight-bold display-4 animate-title">{{ $destination->name }}</h1>
                            <h3 class="text-white font-weight-light animate-subtitle">{{ $destination->slogan }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="section text-center">
                    <h2 class="title mb-4">Destination Details</h2>
                    <ul class="list-unstyled">
                        <li><strong>Description:</strong> {{ $destination->nom }}</li>
                        <li><strong>Location:</strong> {{ $destination->location }}</li>
                        <li><strong>Attractions:</strong> {{ $destination->attractions }}</li>
                        <li><strong>Best Time to Visit:</strong> {{ $destination->best_time_to_visit }}</li>
                        <li><strong>Impact Environnemental:</strong> {{ $destination->impact_environnemental }}</li>
                    </ul>
                    <a href="{{ route('destinations.index') }}" class="btn btn-primary">Back to Destinations</a>
                </div>
            </div>
        </div>

        <footer class="footer pt-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mb-4 ms-auto">
                        <div>
                            <a href="https://www.creative-tim.com/product/material-kit">
                                <img src="./assets/img/logo-ct-dark.png" class="mb-3 footer-logo" alt="main_logo">
                            </a>
                            <h6 class="font-weight-bolder mb-4">Infinity</h6>
                        </div>
                        <div>
                            <ul class="d-flex flex-row ms-n3 nav">
                                <li class="nav-item">
                                    <a class="nav-link pe-1" href="https://www.facebook.com/CreativeTim/" target="_blank">
                                        <i class="fab fa-facebook text-lg opacity-8"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pe-1" href="https://twitter.com/creativetim" target="_blank">
                                        <i class="fab fa-twitter text-lg opacity-8"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pe-1" href="https://dribbble.com/creativetim" target="_blank">
                                        <i class="fab fa-dribbble text-lg opacity-8"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pe-1" href="https://github.com/creativetimofficial" target="_blank">
                                        <i class="fab fa-github text-lg opacity-8"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pe-1" href="https://www.youtube.com/channel/UCVyTG4sCw-rOvB9oHkzZD1w" target="_blank">
                                        <i class="fab fa-youtube text-lg opacity-8"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Core JS Files -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/0U94xr3j/Ud0hlg3+ZmC5iI39qxt+f+N6fOZMg" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybVz8GGiytE1VZiO6lh7xI0w4gqAaLM7Vhc5VoT+4/JG7G4J4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha384-x2Oqv7/ZpsUiTf5ZUtqPzF95GAe1rP/Zf3L2C4nZnxK+trgK1N6iyhV3eghfwgb" crossorigin="anonymous"></script>
        <script src="assets/js/material-kit.js?v=3.0.0" type="text/javascript"></script>
    </body>
    </html>
</x-layouts.base>
