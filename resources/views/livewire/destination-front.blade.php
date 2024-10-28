<div>
  <!-- Navbar Transparent -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent">
      <div class="container">
          <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1" style="display: block; width: 30px; height: 2px; background-color: white; margin: 5px 0;"></span>
                  <span class="navbar-toggler-bar bar2" style="display: block; width: 30px; height: 2px; background-color: white; margin: 5px 0;"></span>
                  <span class="navbar-toggler-bar bar3" style="display: block; width: 30px; height: 2px; background-color: white; margin: 5px 0;"></span>
              </span>
          </button>
      </div>
  </nav>
  <!-- End Navbar -->

  <div class="page-header min-vh-80" style="background-image: url('https://images.unsplash.com/photo-1630752708689-02c8636b9141?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2490&q=80'); background-size: cover; position: relative; color: white;">
      <span style="background-color: rgba(0, 0, 0, 0.6); position: absolute; top: 0; left: 0; right: 0; bottom: 0;"></span>
      <div class="container" style="position: relative; z-index: 2;">
          <div class="row">
              <div class="col-md-8 mx-auto">
                  <div class="text-center">
                      <h1 class="text-white font-weight-bold display-4" style="opacity: 0.9;">Travel Trek</h1>
                      <h3 class="text-white font-weight-light" style="opacity: 0.7;">Your Journey, One Step at a Time</h3>
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
                          <div class="card shadow-sm border-0" style="border-radius: 8px;">
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
                                  </ul>
                                  <a href="{{ route('destination-detailF', ['id' => $destination->id]) }}" class="btn btn-info" style="margin-top: 10px;">Details</a>

                                  <hr>
                                  <h6>Avis:</h6>
                                  @if($destination->avis->isEmpty())
                                      <p>Aucun avis disponible.</p>
                                  @else
                                      @foreach($destination->avis as $avis)
                                          <div class="review" style="border-top: 1px solid #eee; padding-top: 10px;">
                                              <strong>{{ $avis->user->name }}</strong> - {{ $avis->note }} ⭐
                                              <p>{{ $avis->commentaire }}</p>
                                              <small>{{ $avis->date }}</small>
                                          </div>
                                      @endforeach
                                  @endif

                                  <!-- Review Form -->
                                  @if($destination->avis->isEmpty())
                                  <form wire:submit.prevent="store({{ $destination->id }})" style="margin-top: 20px;">
                                      <div class="mb-3">
                                          <label for="commentaire-{{ $destination->id }}" class="form-label">Votre avis:</label>
                                          <textarea id="commentaire-{{ $destination->id }}" 
                                                    class="form-control" 
                                                    wire:model="commentaire.{{ $destination->id }}" 
                                                    style="width: 100%; padding: 10px;" 
                                                    required></textarea>
                                      </div>
                                      <div class="mb-3">
                                          <label for="note-{{ $destination->id }}" class="form-label">Note:</label>
                                          <select id="note-{{ $destination->id }}" 
                                                  class="form-control" 
                                                  wire:model="note.{{ $destination->id }}" 
                                                  style="width: 100%; padding: 10px;" 
                                                  required>
                                              <option value="">Sélectionnez une note</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                      </div>
                                      <button type="submit" class="btn btn-info" style="width: 100%;">Soumettre Avis</button>
                                  </form>
                                   @endif
                              </div>
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

  <footer class="footer pt-5 mt-5" style="background-color: #333; color: #fff; padding: 2rem;">
      <div class="container">
          <div class="row">
              <div class="col-md-3 mb-4 ms-auto">
                  <div>
                      <h6 class="font-weight-bolder mb-4" style="color: white;">Infinity</h6>
                  </div>
                  <div>
                      <ul class="d-flex flex-row ms-n3 nav">
                          <li class="nav-item">
                              <a class="nav-link pe-1" href="https://www.facebook.com/CreativeTim/" target="_blank">
                                  <i class="fab fa-facebook text-lg opacity-8" style="color: white;"></i>
                              </a>
                          </li>
                          <!-- Add other social icons similarly -->
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </footer>
</div>
