<div> <!-- Single root element wrapping the entire Livewire component -->

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
              <h1 class="text-white font-weight-bold display-4 animate-title">Travel Trek</h1>
              <h3 class="text-white font-weight-light animate-subtitle">Your Journey, One Step at a Time</h3>
              <!-- Animation Styles -->
              <style>
                @keyframes fadeInSlideUp {
                  0% { opacity: 0; transform: translateY(20px); }
                  100% { opacity: 1; transform: translateY(0); }
                }
                .animate-title { animation: fadeInSlideUp 1s ease-out forwards; }
                .animate-subtitle { animation: fadeInSlideUp 1.2s ease-out forwards; animation-delay: 0.5s; }
              </style>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Header Section -->
  
    <!-- Main Content Section -->
    <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
      <div class="container">
        <div class="section text-center">
          <h2 class="title mb-4">Itineraries</h2>
          <div class="row">
          @php
              $hasReservedItineraire = $userReservedItineraireIds->isNotEmpty(); // Check if user has any reservations
          @endphp
            @foreach($selectedDestination->itineraire as $itineraire)
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                  <!-- Itinerary Image -->
                  <img src="{{ asset('storage/' . $itineraire->image_url) }}" alt="{{ $itineraire->titre }}" class="card-img-top img-fluid rounded-top" style="height: 200px; object-fit: cover;">
                  
                  <!-- Itinerary Details -->
                  <div class="card-body">
                    <h5 class="card-title">{{ $itineraire->titre }}</h5>
                    <p class="card-text">{{ Str::limit($itineraire->description, 100) }}</p>
                    <ul class="list-unstyled">
                      <li><strong>Durée:</strong> {{ $itineraire->duree }}</li>
                      <li><strong>Prix:</strong> {{ $itineraire->prix }}</li>
                      <li><strong>Difficulté:</strong> {{ $itineraire->difficulte }}</li>
                      <li><strong>Impact Carbone:</strong> {{ $itineraire->impact_carbone }}</li>
                    </ul>
  
                    <!-- Display Associated Steps -->
                    @if($itineraire->etapes->isNotEmpty())
                      <h6 style="color: blue;">Étapes associées:</h6>
                      <ul class="list-unstyled">
                        @foreach($itineraire->etapes as $etape)
                          <li>{{ $etape->nom_etape }}</li>
                        @endforeach
                      </ul>
                    @else
                      <p>Aucune étape associée.</p>
                    @endif
  
                    <!-- Link to View Steps -->
                    <a href="{{ route('etapes.frontIndex', ['itineraire_id' => $itineraire->id]) }}" class="btn btn-info animated-button">Voir Étapes Associées</a>
                    @if ($hasReservedItineraire && $userReservedItineraireIds->contains($itineraire->id))
                        <!-- Show the reserved itinerary button -->
                        <button class="btn btn-secondary" disabled>Déjà réservé</button>
                    @elseif ($hasReservedItineraire)
                        <!-- Disable button for all other itineraries if one is reserved -->
                        <button class="btn btn-secondary" disabled>Réserver</button>
                    @else
                        <!-- Show normal button if no reservations exist -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal{{ $itineraire->id }}">Réserver</button>
                    @endif
<!-- Modal -->
<div class="modal fade" id="reservationModal{{ $itineraire->id }}" tabindex="-1" aria-labelledby="reservationModalLabel{{ $itineraire->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel{{ $itineraire->id }}">Compléter la Réservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="itineraire_id" value="{{ $itineraire->id }}">
                    <input type="hidden" name="source" value="frontoffice">
                    
                    <div class="mb-3">
                        <label for="transport_id" class="form-label">Transport</label>
                        <select class="form-select" id="transport_id" name="transport_id" required>
                            <option value="">Sélectionnez un transport</option>
                            @foreach ($transports as $transport)
                                <option value="{{ $transport->id }}">{{ $transport->nom_trans }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="hebergement_id" class="form-label">Hébergement</label>
                        <select class="form-select" id="hebergement_id" name="hebergement_id" required>
                            <option value="">Sélectionnez un hébergement</option>
                            @foreach ($hebergements as $hebergement)
                                <option value="{{ $hebergement->id }}">{{ $hebergement->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Confirmer la Réservation</button>
                </form>
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
            @endforeach
  
            <!-- No Itineraries Message -->
            @if($selectedDestination->itineraire->isEmpty())
              <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                  No itineraries found.
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- End Main Content Section -->
  
    <!-- Footer Section -->
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
            <!-- Social Media Links -->
            <div>
              <ul class="d-flex flex-row ms-n3 nav">
                <li class="nav-item"><a class="nav-link pe-1" href="https://www.facebook.com/CreativeTim/" target="_blank"><i class="fab fa-facebook text-lg opacity-8"></i></a></li>
                <li class="nav-item"><a class="nav-link pe-1" href="https://twitter.com/creativetim" target="_blank"><i class="fab fa-twitter text-lg opacity-8"></i></a></li>
                <li class="nav-item"><a class="nav-link pe-1" href="https://dribbble.com/creativetim" target="_blank"><i class="fab fa-dribbble text-lg opacity-8"></i></a></li>
                <li class="nav-item"><a class="nav-link pe-1" href="https://github.com/creativetimofficial" target="_blank"><i class="fab fa-github text-lg opacity-8"></i></a></li>
                <li class="nav-item"><a class="nav-link pe-1" href="https://www.youtube.com/channel/UCVyTG4sCw-rOvB9oHkzZD1w" target="_blank"><i class="fab fa-youtube text-lg opacity-8"></i></a></li>
              </ul>
            </div>
          </div>
  
          <!-- Footer Links Sections (Company, Resources, Support, Legal) -->
          <div class="col-md-2 col-sm-6 col-6 mb-4"><h6 class="text-sm">Company</h6><ul class="flex-column ms-n3 nav"><li class="nav-item"><a class="nav-link" href="#">About Us</a></li></ul></div>
          <div class="col-md-2 col-sm-6 col-6 mb-4"><h6 class="text-sm">Resources</h6><ul class="flex-column ms-n3 nav"><li class="nav-item"><a class="nav-link" href="#">Illustrations</a></li></ul></div>
          <div class="col-md-2 col-sm-6 col-6 mb-4"><h6 class="text-sm">Help & Support</h6><ul class="flex-column ms-n3 nav"><li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li></ul></div>
          <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto"><h6 class="text-sm">Legal</h6><ul class="flex-column ms-n3 nav"><li class="nav-item"><a class="nav-link" href="#">Privacy Policy</a></li></ul></div>
  
          <!-- Footer Copyright -->
          <div class="col-12">
            <div class="text-center">
              <p class="text-dark my-4 text-sm font-weight-normal">All rights reserved. Copyright © <script>document.write(new Date().getFullYear())</script> Material Kit by <a href="#" target="_blank">Creative Tim</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- End Footer Section -->
  
  </div> <!-- End of Single Root Element -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  