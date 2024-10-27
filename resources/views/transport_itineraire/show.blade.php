<x-layouts.app>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h1 class="mb-4">{{ $transportItineraire->distance }} km Itinerary</h1>
                <p class="lead">{{ $transportItineraire->transport->nom_trans }} - {{ $transportItineraire->duree }} hrs</p>

                <div class="mb-3">
                    <h5>Details:</h5>
                    <ul class="list-unstyled">
                        <li><strong>Distance:</strong> {{ $transportItineraire->distance }} km</li>
                        <li><strong>Duration:</strong> {{ $transportItineraire->duree }} hrs</li>
                        <li><strong>Transport Mode:</strong> {{ $transportItineraire->transport->nom_trans }}</li>
                        <li><strong>Transport Mode:</strong> {{ $transportItineraire->destination->nom }}</li>
                    </ul>
                </div>

                <div class="mb-4">
                    <a href="{{ route('transport_itineraires.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
