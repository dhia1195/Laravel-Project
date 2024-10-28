<x-layouts.app>
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Services</h1>
        <a href="{{ route('services_hebergement.create') }}" class="btn btn-success mb-3">Ajouter un Service</a>
        
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Disponibilité</th>
                    <th>Prix</th>
                    <th>Hébergement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->service_nom }}</td>
                        <td>{{ $service->description }}</td>
                        <td>{{ $service->disponibilite ? 'Disponible' : 'Non disponible' }}</td>
                        <td>{{ $service->prix_service }} €</td>
                        <td>{{ $service->hebergement->nom }}</td>
                        <td>
                            <!-- Details Button Triggering Modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailsServiceModal-{{ $service->id }}">
                                Détails
                            </button>

                            <!-- Edit Button Triggering Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal-{{ $service->id }}">
                                Modifier
                            </button>

                            <!-- Delete Button Triggering Confirmation Modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $service->id }}">
                                Supprimer
                            </button>

                            <!-- Confirmation Modal -->
                            <div class="modal fade" id="confirmDeleteModal-{{ $service->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $service->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $service->id }}">Confirmer la suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer ce service ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('services_hebergement.destroy', $service->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Details Modal -->
                            <div class="modal fade" id="detailsServiceModal-{{ $service->id }}" tabindex="-1" aria-labelledby="detailsModalLabel-{{ $service->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailsModalLabel-{{ $service->id }}">Détails du Service</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Nom du service:</strong> {{ $service->service_nom }}</p>
                                            <p><strong>Description:</strong> {{ $service->description }}</p>
                                            <p><strong>Disponibilité:</strong> {{ $service->disponibilite ? 'Disponible' : 'Non disponible' }}</p>
                                            <p><strong>Prix:</strong> {{ $service->prix_service }} €</p>
                                            <p><strong>Hébergement:</strong> {{ $service->hebergement->nom }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editServiceModal-{{ $service->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $service->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel-{{ $service->id }}">Modifier le Service</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('services_hebergement.update', $service->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
    <label for="hebergement_id" class="form-label">Hébergement :</label>
    <select name="hebergement_id" id="hebergement_id" class="form-select" required>
        <option value="">Sélectionnez un hébergement</option>
        @foreach ($hebergements as $hebergement)
            <option value="{{ $hebergement->id }}" {{ $service->hebergement_id == $hebergement->id ? 'selected' : '' }}>
                {{ $hebergement->nom }} 
            </option>
        @endforeach
    </select>
</div>

                                        <div class="mb-3">
                                            <label for="service_nom" class="form-label">Nom du service :</label>
                                            <input type="text" name="service_nom" class="form-control" value="{{ old('service_nom', $service->service_nom) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description :</label>
                                            <textarea name="description" class="form-control" required>{{ old('description', $service->description) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="disponibilite" class="form-label">Disponibilité :</label>
                                            <select name="disponibilite" class="form-select">
                                                <option value="1" {{ $service->disponibilite ? 'selected' : '' }}>Disponible</option>
                                                <option value="0" {{ !$service->disponibilite ? 'selected' : '' }}>Non disponible</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prix_service" class="form-label">Prix :</label>
                                            <input type="number" name="prix_service" class="form-control" step="0.01" value="{{ old('prix_service', $service->prix_service) }}" required>
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
