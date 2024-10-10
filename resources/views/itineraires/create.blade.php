<x-layouts.app>
    <div class="container">
        <h1>Create New Itinerary</h1>

        <form action="{{ route('itineraires.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control" id="titre" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="duree">Durée (hours)</label>
                <input type="number" name="duree" class="form-control" id="duree" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix (€)</label>
                <input type="number" name="prix" class="form-control" id="prix" required>
            </div>
            <div class="form-group">
                <label for="difficulte">Difficulté</label>
                <input type="text" name="difficulte" class="form-control" id="difficulte" required>
            </div>
            <div class="form-group">
                <label for="impact_carbone">Impact Carbone (kg)</label>
                <input type="number" name="impact_carbone" class="form-control" id="impact_carbone" required>
            </div>
            <div class="form-group">
                <label for="image_url">Choose Image</label>
                <input type="file" name="image_url" class="form-control-file" id="image_url"> 
            </div>
            <button type="submit" class="btn btn-primary">Create Itinerary</button>
        </form>
    </div>
    </x-layouts.app>
