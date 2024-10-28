<x-layouts.app>
    <div class="container mt-5">
        <h1>Add a Transport Itinerary:</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('transport_itineraires.store') }}" method="POST">
            @csrf
            
    <div class="form-group">
        <label for="destination_id">Destination:</label>
        <select name="destination_id" class="form-control" required>
            <option value="">Select Destination</option>
            @foreach($destinations as $destination)
                <option value="{{ $destination->id }}">{{ $destination->nom }}</option>
            @endforeach
        </select>
    </div>
            <div class="form-group">
                <label for="transport_id">Transport ID:</label>
                <select name="transport_id" id="transport_id" class="form-control" required>
                    @foreach ($transports as $transport)
                        <option value="{{ $transport->id }}">{{ $transport->nom_trans }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="distance">Distance:</label>
                <input type="number" name="distance" id="distance" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="duree">Duration:</label>
                <input type="number" step="0.01" name="duree" id="duree" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</x-layouts.app>
