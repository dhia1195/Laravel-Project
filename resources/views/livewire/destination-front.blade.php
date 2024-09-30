<div class="container" style="margin-top: 100px;">
    <h1 class="mb-4 text-center">Destinations Disponibles</h1>

    @if($destinations->isEmpty())
        <div class="alert alert-warning text-center">Aucune destination disponible pour le moment.</div>
    @else
        <div class="row">
            @foreach($destinations as $destination)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        @if($destination->image_url)
                            <img src="{{ asset('storage/' . $destination->image_url) }}" class="card-img-top" alt="{{ $destination->nom }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $destination->nom }}</h5>
                            <p class="card-text">{{ Str::limit($destination->description, 100) }}</p>
                            <p><strong>Pays:</strong> {{ $destination->pays }}</p>
                            <p><strong>Region:</strong> {{ $destination->region }}</p>
                            <p><strong>Type de Tourisme:</strong> {{ $destination->typeTourisme }}</p>
                            <div class="d-flex justify-content-between">
                                <button wire:click="showDetails({{ $destination->id }})" class="btn btn-primary">Show Details</button>
                               
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Modal for showing destination details --}}
    @if($selectedDestination)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $selectedDestination->nom }}</h5>
                    <button type="button" class="close" wire:click="closeDetails">&times;</button>
                </div>
                <div class="modal-body">
                    <p><strong>Description:</strong> {{ $selectedDestination->description }}</p>
                    <p><strong>Pays:</strong> {{ $selectedDestination->pays }}</p>
                    <p><strong>Region:</strong> {{ $selectedDestination->region }}</p>
                    <p><strong>Type de Tourisme:</strong> {{ $selectedDestination->typeTourisme }}</p>
                    @if($selectedDestination->image_url)
                        <img src="{{ asset('storage/' . $selectedDestination->image_url) }}" class="img-fluid" alt="{{ $selectedDestination->nom }}">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDetails">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>
