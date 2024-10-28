<x-layouts.app>
    <div class="container mt-5">
        <h1 class="mb-4">Ajouter un Service</h1>
        <form action="{{ route('services_hebergement.store') }}" method="POST">
            @csrf

            <!-- Hébergement Selection -->
            <div class="mb-3">
                <label for="hebergement_id" class="form-label">Hébergement:</label>
                <select name="hebergement_id" id="hebergement_id" class="form-select" required>
                    @foreach ($hebergements as $hebergement)
                        <option value="{{ $hebergement->id }}">{{ $hebergement->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Service Name Field -->
            <div class="mb-3">
                <label for="service_nom" class="form-label">Nom du Service:</label>
                <input type="text" name="service_nom" id="service_nom" class="form-control" required>
            </div>

            <!-- Service Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <!-- Availability Selection -->
            <div class="mb-3">
                <label for="disponibilite" class="form-label">Disponibilité:</label>
                <select name="disponibilite" id="disponibilite" class="form-select" required>
                    <option value="1">Disponible</option>
                    <option value="0">Non Disponible</option>
                </select>
            </div>

            <!-- Service Price Field -->
            <div class="mb-3">
                <label for="prix_service" class="form-label">Prix du service:</label>
                <input type="number" name="prix_service" class="form-control" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</x-layouts.app>
