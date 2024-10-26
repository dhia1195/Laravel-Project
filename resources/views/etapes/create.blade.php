<x-layouts.app>
    <div class="container">
        <h1>Créer une nouvelle Étape</h1>

        <form action="{{ route('etapes.store') }}" method="POST" onsubmit="return validateForm()">
            @csrf

            <div class="form-group">
                <label for="itineraire_id">Itinéraire</label>
                <select class="form-control" id="itineraire_id" name="itineraire_id" required>
                    @foreach($itineraires as $itineraire)
                        <option value="{{ $itineraire->id }}">{{ $itineraire->titre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nom_etape">Nom de l'Étape</label>
                <input type="text" class="form-control" id="nom_etape" name="nom_etape" value="{{ old('nom_etape') }}" required pattern="[A-Za-z\s]+" title="Please enter a name using only letters and spaces.">
            </div>

            <div class="form-group">
                <label for="description_etape">Description</label>
                <textarea class="form-control" id="description_etape" name="description_etape" required pattern="[A-Za-z\s]+" title="Please enter a description using only letters and spaces.">{{ old('description_etape') }}</textarea>
            </div>

            <div class="form-group">
                <label for="ordre_etape">Ordre</label>
                <input type="number" class="form-control" id="ordre_etape" name="ordre_etape" value="{{ old('ordre_etape') }}" required min="1" title="Please enter a valid order number.">
            </div>

            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="number" step="0.000001" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}" required>
            </div>

            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="number" step="0.000001" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Créer Étape</button>
        </form>
    </div>

    <script>
        function validateForm() {
            const nomEtape = document.getElementById('nom_etape').value;
            const descriptionEtape = document.getElementById('description_etape').value;
            const regex = /^[A-Za-z\s]+$/;

            // Validate Nom de l'Étape
            if (!regex.test(nomEtape)) {
                alert('Le nom de l\'étape doit contenir uniquement des lettres et des espaces.');
                return false;
            }

            // Validate Description
            if (!regex.test(descriptionEtape)) {
                alert('La description doit contenir uniquement des lettres et des espaces.');
                return false;
            }

            return true;
        }
    </script>
</x-layouts.app>
