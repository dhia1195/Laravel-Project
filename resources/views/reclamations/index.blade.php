<x-layouts.app>
    <div class="my-4 mx-4">
    <div class="my-4 mx-4">
    <!-- Button to open the create reclamation modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createReclamationModal">
        Add Reclamation
    </button>
        <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Liste des réclamations</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <div style="max-height: 500px; overflow-y: auto;">
                        <ul class="list-group">
                        <!-- Loop through the reclamations and display them -->
                        @foreach ($reclamations as $reclamation)
                        <li class="list-group-item border-0 d-flex flex-column p-4 mb-2 bg-gray-100 border-radius-lg">
                                
                                <!-- Title centered -->
                                <div class="d-flex flex-column">
                                        <!-- Titre as Company Name -->
                                        <h6 class="mb-3 text-center text-md" style="color: #ff6347;">{{ $reclamation->titre }}</h6>
                                </div>

                                <span class="text-md">Utilisateur: 
                                        <span class="text-dark ms-2 font-weight-bold">
                                                {{ $reclamation->user->name }} <!-- Display user's name -->
                                        </span>
                                </span>
                                
                                <!-- Description and Buttons side by side -->
                                <div class="d-flex justify-content-between align-items-center">
                                        <!-- Description with larger text -->
                                        <span class="text-md">Description: 
                                                <span class="text-dark ms-2 font-weight-bold">
                                                        {{ $reclamation->description }}
                                                </span>
                                        </span>
                                        
                                        <!-- Buttons -->
                                        <div >
                                                <form action="{{ route('reclamations.destroy', $reclamation->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger text-gradient mb-0">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                        </button>
                                                </form>
                                                <button type="button" class="btn btn-link text-dark mb-0" data-bs-toggle="modal" data-bs-target="#updateReclamationModal{{ $reclamation->id }}">
                                                        <i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit
                                                </button>
                                        </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4 mb-1">
                                        <!-- Date Created on the left -->
                                        <span class="text-xs">Date de création: 
                                        <span class="text-dark ms-2 font-weight-bold">
                                                @if ($reclamation->created_at)
                                                {{ $reclamation->created_at->format('Y-m-d') }}
                                                @else
                                                N/A
                                                @endif
                                        </span>
                                        </span>

                                        <span class="text-xs">Date de modification: 
                                                <span class="text-dark ms-2 font-weight-bold">
                                                        @if ($reclamation->updated_at)
                                                        {{ $reclamation->updated_at->format('Y-m-d') }}
                                                        @else
                                                        N/A
                                                        @endif
                                                </span>
                                        </span>
                                </div>
                                </li>

                                <div class="modal fade" id="updateReclamationModal{{ $reclamation->id }}" tabindex="-1" aria-labelledby="updateReclamationModalLabel{{ $reclamation->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                        <h5 class="modal-title" id="updateReclamationModalLabel{{ $reclamation->id }}">Update Reclamation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        <form action="{{ route('reclamations.update', $reclamation->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                                <label for="titre" class="form-label">Title</label>
                                                                <input type="text" class="form-control" name="titre" value="{{ $reclamation->titre }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                                <label for="description" class="form-label">Description</label>
                                                                <textarea class="form-control" name="description" required>{{ $reclamation->description }}</textarea>
                                                        </div>
                                                        <!-- Add other fields as necessary -->
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update Reclamation</button>
                                                        </div>
                                                        </form>
                                                </div>
                                                </div>
                                        </div>
                                        </div>


                        @endforeach
                        </ul>
                        </div>
                    </div>
                </div>
    </div>

    <!-- Create Reclamation Modal -->
        <div class="modal fade" id="createReclamationModal" tabindex="-1" aria-labelledby="createReclamationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="createReclamationModalLabel">Add New Reclamation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form action="{{ route('reclamations.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                                <label for="titre" class="form-label">Title</label>
                                <input type="text" class="form-control" name="titre" required>
                        </div>
                        <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <!-- Add other fields as necessary -->
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Reclamation</button>
                        </div>
                        </form>
                </div>
                </div>
        </div>
        </div>
  </x-layouts.app>
