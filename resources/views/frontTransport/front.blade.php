
    <div class="container mt-5">
        <h1 class="text-center mb-4">List of Available Transports</h1>

        @if($transports->isEmpty())
            <div class="alert alert-warning text-center">No transportation available at this time.</div>
        @else
            <div class="row">
                @foreach($transports as $transport)
                    <div class="col-md-4 mb-3">
                        <div class="card" style="border-radius: 10px; border: 1px solid #e0e0e0;">
                            <div class="card-body" style="background-color: {{ $loop->even ? '#f8f9fa' : '#ffffff' }};">
                                <h5 class="card-title">{{ $transport->nom_trans }}</h5>
                                <p class="card-text"><strong>Type:</strong> {{ $transport->type_trans }}</p>
                                <p class="card-text"><strong>Prix:</strong> {{ number_format($transport->prix_trans, 2) }} TND</p>
                                <p class="card-text"><strong>Impact Carbone:</strong> {{ $transport->impact_carbone }} kg CO2</p>
                                <a href="{{ route('frontTransport.showFront', $transport->id) }}" class="btn btn-primary">Voir Détails</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
