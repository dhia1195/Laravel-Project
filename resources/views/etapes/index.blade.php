<x-layouts.app>
    <div class="container">
        <h1>Liste des Étapes</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('etapes.create') }}" class="btn btn-primary mb-3">Créer une nouvelle Étape</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom de l'Étape</th>
                    <th>Description</th>
                    <th>Ordre</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Itinéraire</th>
                    <th>Actions</th> <!-- Added column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach($etapes as $etape)
                    <tr>
                        <td>{{ $etape->nom_etape }}</td>
                        <td>{{ $etape->description_etape }}</td>
                        <td>{{ $etape->ordre_etape }}</td>
                        <td>{{ $etape->latitude }}</td>
                        <td>{{ $etape->longitude }}</td>
                        <td>{{ $etape->itineraire->titre }}</td>
                        <td>
                            <!-- Update button triggers modal -->
                            <button class="btn btn-primary" onclick="showEditModal({{ $etape->id }})">Modifier</button>

                            <!-- Delete form -->
                            <form action="{{ route('etapes.destroy', $etape->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for editing an étape -->
    <div class="modal fade" id="editEtapeModal" tabindex="-1" aria-labelledby="editEtapeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEtapeModalLabel">Modifier Étape</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside the modal -->
                    <form id="editEtapeForm" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="nom_etape" class="form-label">Nom de l'Étape</label>
                            <input type="text" class="form-control" id="nom_etape" name="nom_etape">
                        </div>

                        <div class="mb-3">
                            <label for="description_etape" class="form-label">Description de l'Étape</label>
                            <textarea class="form-control" id="description_etape" name="description_etape"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="ordre_etape" class="form-label">Ordre</label>
                            <input type="number" class="form-control" id="ordre_etape" name="ordre_etape">
                        </div>

                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude">
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude">
                        </div>

                        <div class="mb-3">
                            <label for="itineraire_id" class="form-label">Itinéraire</label>
                            <select class="form-select" id="itineraire_id" name="itineraire_id">
                                @foreach($itineraires as $itineraire)
                                    <option value="{{ $itineraire->id }}">{{ $itineraire->titre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showEditModal(id) {
            fetch(`/etapes/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Populate the form with the fetched data
                    document.getElementById('nom_etape').value = data.etape.nom_etape;
                    document.getElementById('description_etape').value = data.etape.description_etape;
                    document.getElementById('ordre_etape').value = data.etape.ordre_etape;
                    document.getElementById('latitude').value = data.etape.latitude;
                    document.getElementById('longitude').value = data.etape.longitude;
                    document.getElementById('itineraire_id').value = data.etape.itineraire_id;

                    // Set the action for the form
                    document.getElementById('editEtapeForm').action = `/etapes/${id}`;

                    // Show the modal
                    new bootstrap.Modal(document.getElementById('editEtapeModal')).show();
                });
        }
    </script>
</x-layouts.app>
