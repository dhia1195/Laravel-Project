<div>
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
          <h2 class="title mb-4">Destinations</h2>
          <div class="row">
            @foreach($destinations as $destination)
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                  <img src="{{ asset('storage/' . $destination->image_url) }}" 
                       alt="{{ $destination->nom }}" 
                       class="card-img-top img-fluid rounded-top" 
                       style="height: 200px; object-fit: cover;">
                  <div class="card-body">
                    <h5 class="card-title">{{ $destination->nom }}</h5>
                    <p class="card-text">{{ Str::limit($destination->description, 100) }}</p>
                    <ul class="list-unstyled">
                      <li><strong>Pays:</strong> {{ $destination->pays }}</li>
                      <li><strong>Région:</strong> {{ $destination->region }}</li>
                      <li><strong>Type de Tourisme:</strong> {{ $destination->typeTourisme }}</li>
                      <li><strong>Impact Environnemental:</strong> {{ $destination->impact_env }}</li>
                      <a href="{{ route('destination-detailF', ['id' => $destination->id]) }}" class="btn btn-info animated-button mt-3">Details</a>
                    </ul>
                    
                    <hr>
                    <h6>Avis:</h6>
                    @if($destination->avis->isEmpty())
                      <p>Aucun avis disponible.</p>
                   
  
                    <!-- Review Form -->
                    <form wire:submit.prevent="store({{ $destination->id }})">
                       
                        <div class="mb-3">
                            <label for="commentaire" class="form-label">Votre avis:</label>
                            <textarea id="commentaire" class="form-control" wire:model="commentaire" required></textarea>
                        </div>
                    
                        <div class="mb-3">
                            <label for="note" class="form-label">Note:</label>
                            <select id="note" class="form-control" wire:model="note" required>
                                <option value="">Sélectionnez une note</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-info">Soumettre Avis</button>
                    </form>
                    
                  </div>
                  @else
                  @foreach($destination->avis as $avis)
                    <div class="review">
                      <strong>{{ $avis->user->name }}</strong> - {{ $avis->note }} ⭐
                      <p>{{ $avis->commentaire }}</p>
                      <small>{{ $avis->date }}</small>
                    </div>
                  @endforeach
                @endif
                </div>
              </div>
            @endforeach
  
            @if($destinations->isEmpty())
              <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                  No destinations found.
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
                  <a class="nav-link" href="https://www.creative-tim.com/presentation" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/templates/free" target="_blank">Freebies</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/templates/premium" target="_blank">Premium Tools</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/contact-us" target="_blank">Contact Us</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-2 col-sm-6 col-6 mb-4">
            <div>
              <h6 class="text-sm">Resources</h6>
              <ul class="flex-column ms-n3 nav">
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/bootstrap-themes" target="_blank">Bootstrap Themes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/faq" target="_blank">FAQ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/blog" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6 mb-4">
            <div>
              <h6 class="text-sm">Follow Us</h6>
              <ul class="flex-column ms-n3 nav">
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/contact-us" target="_blank">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/privacy" target="_blank">Privacy Policy</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.creative-tim.com/terms" target="_blank">Terms of Use</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  