<x-layouts.app>
    <div class="container mt-5">
        <h1 class="mb-4">Ajouter un Hébergement</h1>
        <form action="{{ route('hebergements.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nom" class="form-label">Nom:</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type:</label>
                <input type="text" name="type" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse:</label>
                <input type="text" name="adresse" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="pays" class="form-label">Pays:</label>
                <input type="text" name="pays" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ville" class="form-label">Ville:</label>
                <input type="text" name="ville" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="prix_nuit" class="form-label">Prix par nuit:</label>
                <input type="number" name="prix_nuit" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="impact_environnemental" class="form-label">Impact environnemental:</label>
                <input type="text" name="impact_environnemental" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="image_url" class="form-label"> l'image:</label>
                <input type="url" name="image_url" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</x-layouts.app>
