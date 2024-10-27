<x-layouts.base>
    {{-- Include the existing navbar --}}
    @include('layouts.navbars.guest.login') <!-- Adjust the path if needed -->

    <!doctype html>
    <html lang="en">

    <head>
        <title>Service Hebergement</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!-- Fonts and icons -->
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

        <!-- Header Section -->
        <div class="page-header min-vh-80" style="background-image: url('https://images.unsplash.com/photo-1630752708689-02c8636b9141?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2490&q=80')">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="text-center">
                            <h1 class="text-white font-weight-bold display-4 animate-title">{{ $hebergement->servicehebs->first()->service_nom ?? 'No Service' }}</h1>
                            <h3 class="text-white font-weight-light animate-subtitle">Explore the Details of Our Accommodation Service</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Details Section -->
        <div class="container my-5">
            <h1 class="display-4 text-center mb-4" style="color: #007bff; text-shadow: 2px 2px #e1e1e1;">
                Service Details for {{ $hebergement->servicehebs->first()->service_nom ?? 'No Service' }}
            </h1>
            <p class="lead text-center text-muted mb-5">{{ $hebergement->servicehebs->first()->description ?? 'No description available.' }}</p>

            <div class="row justify-content-center">
                @foreach($hebergement->servicehebs as $service)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-lg" style="border: 1px solid #007bff;">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #007bff; font-weight: bold;">{{ $service->service_nom }}</h5>
                            <p class="card-text">{{ $service->description }}</p>
                            <ul class="list-unstyled">
                                <li><strong>Disponibility:</strong> {{ $service->disponibilite ? 'Available' : 'Not Available' }}</li>
                                <li><strong>Price:</strong> ${{ $service->prix_service }}</li>
                            </ul>

                            @if ($service->hebergement)
                                <hr>
                                <h6 class="card-subtitle mb-2 text-muted">Associated Hebergement Details</h6>
                                <ul class="list-unstyled">
                                    <li><strong>Hebergement Name:</strong> {{ $service->hebergement->name }}</li>
                                    <li><strong>Location:</strong> {{ $service->hebergement->location }}</li>
                                    <!-- Additional Hebergement details can be added here -->
                                </ul>
                            @else
                                <p>No associated accommodation.</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer pt-5 mt-5">
            <div class="container">
                <!-- Footer Content -->
            </div>
        </footer>
    </body>

    </html>
</x-layouts.base>
