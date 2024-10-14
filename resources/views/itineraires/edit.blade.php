    <div class="container">
        <h1>Modifier l'Itinéraire</h1>
        <form action="{{ route('itineraires.update', $itineraire->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control" value="{{ $itineraire->titre }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $itineraire->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="duree">Durée (heures)</label>
                <input type="number" name="duree" class="form-control" value="{{ $itineraire->duree }}" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix (en €)</label>
                <input type="number" name="prix" class="form-control" value="{{ $itineraire->prix }}" required>
            </div>
            <div class="form-group">
                <label for="difficulte">Difficulté</label>
                <input type="text" name="difficulte" class="form-control" value="{{ $itineraire->difficulte }}" required>
            </div>
            <div class="form-group">
                <label for="impact_carbone">Impact Carbone (kg CO2)</label>
                <input type="number" name="impact_carbone" class="form-control" value="{{ $itineraire->impact_carbone }}" required>
            </div>
            <div class="form-group">
                <label for="image_url">Image</label>
                <input type="file" name="image_url" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>
    </div>
