<x-layouts.app>
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Hébergements</h1>
        <a href="{{ route('hebergements.create') }}" class="btn btn-success mb-3">Ajouter un Hébergement</a>
        
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Prix par nuit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hebergements as $hebergement)
                    <tr>
                        <td>{{ $hebergement->nom }}</td>
                        <td>{{ $hebergement->description }}</td>
                        <td>{{ $hebergement->type }}</td>
                        <td>{{ $hebergement->prix_nuit }} €</td>
                        <td>
                            <!-- Details Button Triggering Modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailsHebergementModal-{{ $hebergement->id }}">
                                Détails
                            </button>

                            <!-- Edit Button Triggering Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editHebergementModal-{{ $hebergement->id }}">
                                Modifier
                            </button>

                            <!-- Delete Button Triggering Confirmation Modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $hebergement->id }}">
                                Supprimer
                            </button>

                            <!-- Confirmation Modal -->
                            <div class="modal fade" id="confirmDeleteModal-{{ $hebergement->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $hebergement->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $hebergement->id }}">Confirmer la suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer cet hébergement ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('hebergements.destroy', $hebergement->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Details Modal -->
                    <div class="modal fade" id="detailsHebergementModal-{{ $hebergement->id }}" tabindex="-1" aria-labelledby="detailsModalLabel-{{ $hebergement->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailsModalLabel-{{ $hebergement->id }}">Détails de l'Hébergement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nom:</strong> {{ $hebergement->nom }}</p>
                                    <p><strong>Description:</strong> {{ $hebergement->description }}</p>
                                    <p><strong>Type:</strong> {{ $hebergement->type }}</p>
                                    <p><strong>Adresse:</strong> {{ $hebergement->adresse }}</p>
                                    <p><strong>Pays:</strong> {{ $hebergement->pays }}</p>
                                    <p><strong>Ville:</strong> {{ $hebergement->ville }}</p>
                                    <p><strong>Prix par nuit:</strong> {{ $hebergement->prix_nuit }} €</p>
                                    <p><strong>Impact environnemental:</strong> {{ $hebergement->impact_environnemental }}</p>
                                    <p><strong>Image:</strong></p>
                                    <img src="{{ $hebergement->image_url }}" alt="Image de {{ $hebergement->nom }}" class="img-fluid" style="max-width: 100%; height: auto;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editHebergementModal-{{ $hebergement->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $hebergement->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel-{{ $hebergement->id }}">Modifier l'Hébergement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('hebergements.update', $hebergement->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom :</label>
                                            <input type="text" name="nom" class="form-control" value="{{ old('nom', $hebergement->nom) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description :</label>
                                            <textarea name="description" class="form-control" required>{{ old('description', $hebergement->description) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="type" class="form-label">Type :</label>
                                            <input type="text" name="type" class="form-control" value="{{ old('type', $hebergement->type) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="adresse" class="form-label">Adresse :</label>
                                            <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $hebergement->adresse) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pays" class="form-label">Pays :</label>
                                            <input type="text" name="pays" class="form-control" value="{{ old('pays', $hebergement->pays) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ville" class="form-label">Ville :</label>
                                            <input type="text" name="ville" class="form-control" value="{{ old('ville', $hebergement->ville) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prix_nuit" class="form-label">Prix par nuit :</label>
                                            <input type="number" name="prix_nuit" class="form-control" step="0.01" value="{{ old('prix_nuit', $hebergement->prix_nuit) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="impact_environnemental" class="form-label">Impact environnemental :</label>
                                            <input type="text" name="impact_environnemental" class="form-control" value="{{ old('impact_environnemental', $hebergement->impact_environnemental) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image_url" class="form-label">Image :</label>
                                            <input type="url" name="image_url" class="form-control" value="{{ old('image_url', $hebergement->image_url) }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
