<x-layouts.base>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="display-4">{{ $transport->nom_trans }}</h1>
        </div>

        <div class="card shadow-sm border-light">
            <div class="card-body">
                <h5 class="card-title"><strong>Type:</strong> {{ $transport->type_trans }}</h5>
                <p class="card-text"><strong>Price:</strong> {{ number_format($transport->prix_trans, 2) }} TND</p>
                <p class="card-text"><strong>Impact Environmental:</strong> {{ $transport->impact_carbone }} kg CO2</p>
                
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('frontTransport.front') }}" class="btn btn-secondary">Back to List</a>
                  
                </div>
            </div>
        </div>
    </div>
</x-layouts.base>
