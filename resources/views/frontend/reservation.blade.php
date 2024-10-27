 <!-- Adjust the path if needed -->
 <x-layouts.base>
    {{-- Include the existing navbar --}}
    @include('layouts.navbars.guest.login')
    <!doctype html>
        <html lang="en">

        <head>
        <title>reclamation</title>
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
            
                </ul>
            </div>
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
                transform: translateY(20px);}
            100% {
                opacity: 1;
                transform: translateY(0);}}
        .animate-title {
            animation: fadeInSlideUp 1s ease-out forwards;
        }
        .animate-subtitle {
            animation: fadeInSlideUp 1.2s ease-out forwards;
            animation-delay: 0.5s; }

            .form-control {
                border: 1px solid #ced4da; /* Bootstrap's default border color */
                border-radius: .25rem; /* Optional: same as Bootstrap default */
                box-shadow: none; /* Optional: remove box-shadow if you want a flat look */
            }

            .form-control:focus {
                border-color: #80bdff; /* Bootstrap's focus border color */
                outline: 0; /* Remove outline */
                box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25); /* Bootstrap's focus shadow */
            }
        </style>

                </div>
                </div>
            </div>
            </div>
        </div>

    <div class="container my-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">List of Reservations</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <div style="max-height: 500px; overflow-y: auto;">
                <ul class="list-group">
                    @foreach ($reservations as $reservation)
                    <li class="list-group-item border-0 d-flex flex-column p-4 mb-2 bg-gray-100 border-radius-lg">
                        <h6 class="mb-3 text-center" style="color: #ff6347;">{{ $reservation->titre }}</h6>
                        <span class="text-md">Itinerary: <span class="text-dark font-weight-bold">{{ $reservation->itineraire->titre }}</span></span>
                        <span class="text-md">Accommodation: <span class="text-dark font-weight-bold">{{ $reservation->hebergement->nom }}</span></span>
                        <span class="text-md">Transport: <span class="text-dark font-weight-bold">{{ $reservation->transport->nom_trans }}</span></span>
                        <span class="text-md">User: <span class="text-dark font-weight-bold">{{ $reservation->user->name }}</span></span>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger text-gradient mb-0">
                                    <i class="far fa-trash-alt me-2"></i>Delete
                                </button>
                            </form>
                            <button type="button" class="btn btn-link text-dark mb-0" data-bs-toggle="modal" data-bs-target="#updateReservationModal{{ $reservation->id }}">
                                <i class="fas fa-pencil-alt me-2"></i>Edit
                            </button>
                        </div>
                    </li>

                    <!-- Edit Reservation Modal -->
                    <div class="modal fade" id="updateReservationModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="updateReservationModalLabel{{ $reservation->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Reservation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Itinerary</label>
                                        <select class="form-select" name="itineraire_id">
                                            @foreach ($itineraires as $itineraire)
                                            <option value="{{ $itineraire->id }}" {{ $reservation->itineraire_id == $itineraire->id ? 'selected' : '' }}>{{ $itineraire->titre }}</option>
                                            @endforeach
                                        </select>
                                        <label class="mt-3">Accommodation</label>
                                        <select class="form-select" name="hebergement_id">
                                            @foreach ($hebergements as $hebergement)
                                            <option value="{{ $hebergement->id }}" {{ $reservation->hebergement_id == $hebergement->id ? 'selected' : '' }}>{{ $hebergement->nom }}</option>
                                            @endforeach
                                        </select>
                                        <label class="mt-3">Transport</label>
                                        <select class="form-select" name="transport_id">
                                            @foreach ($transports as $transport)
                                            <option value="{{ $transport->id }}" {{ $reservation->transport_id == $transport->id ? 'selected' : '' }}>{{ $transport->nom_trans }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Reservation</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
    </div>
    <footer class="footer pt-5 mt-5">
    <div class="container">
      <div class=" row">
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
        <div class="col-md-2 col-sm-6 col-6 mb-4">
          <div>
            <h6 class="text-sm">Resources</h6>
            <ul class="flex-column ms-n3 nav">
              <li class="nav-item">
                <a class="nav-link" href="https://iradesign.io/" target="_blank">
                  Illustrations
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.creative-tim.com/bits" target="_blank">
                  Bits & Snippets
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.creative-tim.com/affiliates/new" target="_blank">
                  Affiliate Program
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-6 mb-4">
          <div>
            <h6 class="text-sm">Help & Support</h6>
            <ul class="flex-column ms-n3 nav">
              <li class="nav-item">
                <a class="nav-link" href="https://www.creative-tim.com/contact-us" target="_blank">
                  Contact Us
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.creative-tim.com/knowledge-center" target="_blank">
                  Knowledge Center
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://services.creative-tim.com/?ref=ct-mk2-footer" target="_blank">
                  Custom Development
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.creative-tim.com/sponsorships" target="_blank">
                  Sponsorships
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto">
          <div>
            <h6 class="text-sm">Legal</h6>
            <ul class="flex-column ms-n3 nav">
              <li class="nav-item">
                <a class="nav-link" href="https://www.creative-tim.com/knowledge-center/terms-of-service/" target="_blank">
                  Terms & Conditions
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.creative-tim.com/knowledge-center/privacy-policy/" target="_blank">
                  Privacy Policy
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.creative-tim.com/license" target="_blank">
                  Licenses (EULA)
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-12">
          <div class="text-center">
            <p class="text-dark my-4 text-sm font-weight-normal">
              All rights reserved. Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Material Kit by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>

        </x-layouts.base>