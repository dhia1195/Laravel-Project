<x-layouts.app>

    <div class="container">
        <h1>Créer une nouvelle Étape</h1>

        <form action="{{ route('etapes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="itineraire_id">Itinéraire</label>
                <select class="form-control" id="itineraire_id" name="itineraire_id">
                    @foreach($itineraires as $itineraire)
                        <option value="{{ $itineraire->id }}">{{ $itineraire->titre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nom_etape">Nom de l'Étape</label>
                <input type="text" class="form-control" id="nom_etape" name="nom_etape" value="{{ old('nom_etape') }}">
            </div>

            <div class="form-group">
                <label for="description_etape">Description</label>
                <textarea class="form-control" id="description_etape" name="description_etape">{{ old('description_etape') }}</textarea>
            </div>

            <div class="form-group">
                <label for="ordre_etape">Ordre</label>
                <input type="number" class="form-control" id="ordre_etape" name="ordre_etape" value="{{ old('ordre_etape') }}">
            </div>

            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="number" step="0.000001" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}">
            </div>

            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="number" step="0.000001" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}">
            </div>

            <button type="submit" class="btn btn-success">Créer Étape</button>
        </form>
    </div>

</x-layouts.app>
