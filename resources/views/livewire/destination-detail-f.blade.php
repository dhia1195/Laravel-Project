<!-- Main Content Section -->
<div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
    <div class="container">
        <div class="section text-center">
            <h2 class="title mb-4">Itinéraires</h2>
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

                                <!-- Reservation Button Logic -->
                                @if ($hasReservedItineraire && $userReservedItineraireIds->contains($itineraire->id))
                                    <button class="btn btn-secondary" disabled>Déjà réservé</button>
                                @elseif ($hasReservedItineraire)
                                    <button class="btn btn-secondary" disabled>Réserver</button>
                                @else
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal{{ $itineraire->id }}">Réserver</button>
                                @endif

                                <!-- Modal for Reservation -->
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

                <!-- No Itineraries Message for Main Itineraries -->
                @if($selectedDestination->itineraire->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            Aucun itinéraire trouvé.
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Transport Itineraries Section -->
        <div class="section text-center mt-5">
            <h2 class="title mb-4">Itinéraires de Transport</h2>
            <div class="row">
                @foreach($transport_itineraires as $transport_itineraire)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-sm border-0">
                            <img src="{{ asset('storage/' . $transport_itineraire->image_url) }}" alt="{{ $transport_itineraire->titre }}" class="card-img-top img-fluid rounded-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $transport_itineraire->titre }}</h5>
                                <p class="card-text">{{ Str::limit($transport_itineraire->description, 100) }}</p>
                                <ul class="list-unstyled">
                                    <li><strong>Durée:</strong> {{ $transport_itineraire->duree }}</li>
                                    <li><strong>Prix:</strong> {{ $transport_itineraire->prix }}</li>
                                </ul>

                                <!-- Link to View Transport Details -->
                                <a href="{{ route('transport.show', ['id' => $transport_itineraire->id]) }}" class="btn btn-info">Voir Détails</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- No Transport Itineraries Message -->
                @if($transport_itineraires->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            Aucun itinéraire de transport trouvé.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- End Main Content Section -->
