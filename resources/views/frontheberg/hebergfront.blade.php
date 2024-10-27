<x-layouts.base>
    {{-- Include the existing navbar --}}
    @include('layouts.navbars.guest.login') <!-- Adjust the path if needed -->

    <!doctype html>
    <html lang="en">

    <head>
        <title>Hello, world!</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <!-- Material Kit CSS -->
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

        <div class="page-header min-vh-80" style="background-image: url('https://images.unsplash.com/photo-1630752708689-02c8636b9141?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2490&q=80')">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="text-center">
                            <h1 class="text-white font-weight-bold display-4 animate-title">Travel Trek</h1>
                            <h3 class="text-white font-weight-light animate-subtitle">Your Journey, One Step at a Time</h3>
                            <style>
                                @keyframes fadeInSlideUp {
                                    0% {
                                        opacity: 0;
                                        transform: translateY(20px);
                                    }

                                    100% {
                                        opacity: 1;
                                        transform: translateY(0);
                                    }
                                }

                                .animate-title {
                                    animation: fadeInSlideUp 1s ease-out forwards;
                                }

                                .animate-subtitle {
                                    animation: fadeInSlideUp 1.2s ease-out forwards;
                                    animation-delay: 0.5s;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="section text-center">
                    <h2 class="title mb-4">Hébergements</h2>
                    <div class="row">
                        @foreach($hebergements as $hebergement)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card shadow-sm border-0">
                                    <img src="{{ $hebergement->image_url }}" 
                                         alt="{{ $hebergement->titre }}" 
                                         class="card-img-top img-fluid rounded-top" 
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <!-- Link only on title -->
                                        <h5 class="card-title">
                                            <a href="{{ route('hebergements.show', $hebergement->id) }}" class="text-decoration-none">
                                                {{ $hebergement->titre }}
                                            </a>
                                        </h5>
                                        <p class="card-text">{{ Str::limit($hebergement->description, 100) }}</p>
                                        <ul class="list-unstyled">
                                            <li><strong>Nom:</strong> {{ $hebergement->nom }}</li>
                                            <li><strong>Type:</strong> {{ $hebergement->type }}</li>
                                            <li><strong>Adresse:</strong> {{ $hebergement->adresse }}</li>
                                            <li><strong>Pays:</strong> {{ $hebergement->pays }}</li>
                                            <li><strong>Ville:</strong> {{ $hebergement->ville }}</li>
                                            <li><strong>Capacité:</strong> {{ $hebergement->capacite }}</li>
                                            <li><strong>Prix par nuit:</strong> {{ $hebergement->prix_nuit }} €</li>
                                            <li><strong>Impact environnemental:</strong> {{ $hebergement->impact_environnemental }}</li>
                                        </ul>
                                        <!-- Add the Details button -->
                                        <a href="{{ route('frontheberg.serheber', ['id' => $hebergement->id]) }}" class="btn btn-primary">Details</a>


                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if($hebergements->isEmpty())
                            <div class="col-12">
                                <div class="alert alert-warning text-center" role="alert">
                                    Aucun hébergement trouvé.
                                </div>
                            </div>
                        @endif
                    </div>
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
                    <div class="col-md-2 col-sm-6 col-6 mb-4">
                        <div>
                            <h6 class="text-sm">Company</h6>
                            <ul class="flex-column ms-n3 nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.creative-tim.com/presentation" target="_blank">
                                        About Us
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.creative-tim.com/templates/free" target="_blank">
                                        Freebies
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.creative-tim.com/templates/premium" target="_blank">
                                        Premium Tools
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.creative-tim.com/blog" target="_blank">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!--   Core JS Files   -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/0U94xr3j/Ud0hlg3+ZmC5iI39qxt+f+N6fOZMg" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybVz8GGiytE1VZiO6lh7xI0w4gqAaLM7Vhc5VoT+4/JG7G4J4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha384-x2Oqv7/ZpsUiTf5ZUtqPzF95GAe1rP/Zf3L2C4nZnxK+trgK1N6iyhV3eghfwgb" crossorigin="anonymous"></script>
        <script src="assets/js/material-kit.js?v=3.0.0" type="text/javascript"></script>
    </body>

    </html>
</x-layouts.base>
