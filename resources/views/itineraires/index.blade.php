<x-layouts.app>
    <div class="container">
    <div class="text-center mb-4">
    <h1 class="display-4 font-weight-bold">List of Itineraries</h1>
    <p class="lead text-muted">Explore our collection of curated itineraries designed to inspire your next adventure.</p>
    <i class="fas fa-map-marked-alt fa-2x text-primary"></i> <!-- Font Awesome icon -->
</div>
            <form action="{{ route('itineraires.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by title" value="{{ request()->get('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('itineraires.create') }}" class="btn btn-primary mb-3">Create New Itinerary</a>

        <table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">Durée</th>
            <th scope="col">Prix</th>
            <th scope="col">Difficulté</th>
            <th scope="col">Impact Carbone</th>
            <th scope="col">Destination</th>
            <th scope="col">Image</th> <!-- New Image Column -->
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($itineraires as $itineraire)
            <tr>
                
                <td>{{ $itineraire->titre }}</td>
                <td>{{ Str::limit($itineraire->description, 50) }}</td> <!-- Limit description length -->
                <td>{{ $itineraire->duree }} hours</td>
                <td>{{ $itineraire->prix }} €</td>
                <td>{{ $itineraire->difficulte }}</td>
                <td>{{ $itineraire->impact_carbone }} kg</td>
                <td>{{ $itineraire->destination->nom }} </td>
                <td class="text-center"> <!-- Center the image -->
                    <img src="{{ asset('storage/' . $itineraire->image_url) }}" alt="{{ $itineraire->titre }}" class="img-fluid rounded shadow" style="width: 100px; height: auto;">
                </td>
                <td>
                    <a href="{{ route('itineraires.show', $itineraire->id) }}" class="btn btn-info btn-sm" title="View Itinerary">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="#" class="btn btn-warning btn-sm" onclick="openEditModal({{ $itineraire }})" title="Edit Itinerary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('itineraires.destroy', $itineraire->id) }}" method="POST" style="display:inline-block;" title="Delete Itinerary">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this itinerary?');">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">No itineraries found.</td> <!-- Adjust colspan to 8 -->
            </tr>
        @endforelse
    </tbody>
</table>


    </div>

    <!-- Custom Modal -->
    <div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2 class="text-center">Edit Itinerary</h2>
        <form id="editForm" method="POST" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" id="modal-titre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="modal-description" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="duree">Durée (hours)</label>
                    <input type="number" name="duree" id="modal-duree" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="prix">Prix (€)</label>
                    <input type="number" name="prix" id="modal-prix" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="difficulte">Difficulté</label>
                    <input type="text" name="difficulte" id="modal-difficulte" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="impact_carbone">Impact Carbone (kg)</label>
                    <input type="number" name="impact_carbone" id="modal-impact_carbone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="image_url">Choose Image</label>
                    <input type="file" name="image_url" class="form-control-file" id="modal-image_url">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Itinerary</button>
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<style>
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        left: 0; 
        top: 0; 
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0, 0, 0, 0.5); 
    }
    .modal-content {
        background-color: #fefefe;
        margin: 10% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 90%; 
        max-width: 500px; /* Set max width for a more compact look */
        border-radius: 8px; /* Rounded corners */
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    function openEditModal(itineraire) {
        document.getElementById('modal-titre').value = itineraire.titre;
        document.getElementById('modal-description').value = itineraire.description;
        document.getElementById('modal-duree').value = itineraire.duree;
        document.getElementById('modal-prix').value = itineraire.prix;
        document.getElementById('modal-difficulte').value = itineraire.difficulte;
        document.getElementById('modal-impact_carbone').value = itineraire.impact_carbone;
        document.getElementById('editForm').action = '/itineraires/' + itineraire.id; // Update the form action to the correct route
        document.getElementById('editModal').style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>

</x-layouts.app>
