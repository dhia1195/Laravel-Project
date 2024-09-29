<x-layouts.app>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h1 class="mb-4">{{ $transport->nom_trans }}</h1>
                <p class="lead">{{ $transport->type_trans }}</p>

                <div class="mb-3">
                    <h5>Details:</h5>
                    <ul class="list-unstyled">
                        <li><strong>Type:</strong> {{ $transport->type_trans }}</li>
                        <li><strong>Price:</strong> {{ $transport->prix_trans }} TND</li>
                        <li><strong>Carbon Impact:</strong> {{ $transport->impact_carbone }} kg CO2</li>
                    </ul>
                </div>

                <div class="mb-4">
                    <a href="{{ route('transport.edit', $transport->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('transport.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
