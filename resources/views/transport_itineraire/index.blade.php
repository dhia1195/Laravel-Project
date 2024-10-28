<x-layouts.app>
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Transport Itineraries</h5>
                            </div>
                            <a href="{{ route('transport_itineraires.create') }}" class="btn bg-gradient-primary btn-sm mb-0">
                                +&nbsp; New Itinerary
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Distance</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Duration</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Transport Mode</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transportItineraires as $itineraire)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $itineraire->distance }} km</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $itineraire->duree }} hrs</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $itineraire->destination->nom }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('transport_itineraires.show', $itineraire->id) }}" class="text-info mx-3" data-bs-toggle="tooltip" title="Show Itinerary">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>

                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editItineraireModal-{{ $itineraire->id }}">
                                                Edit
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $itineraire->id }}">
                                                Delete
                                            </button>

                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="confirmDeleteModal-{{ $itineraire->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel-{{ $itineraire->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirmation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this itinerary?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                            <form action="{{ route('transport_itineraires.destroy', $itineraire->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editItineraireModal-{{ $itineraire->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Itinerary</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('transport_itineraires.update', $itineraire->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="distance">Distance:</label>
                                                                    <input type="number" name="distance" class="form-control" value="{{ old('distance', $itineraire->distance) }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="duree">Duration:</label>
                                                                    <input type="number" step="0.01" name="duree" class="form-control" value="{{ old('duree', $itineraire->duree) }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="destination_id">Itinerary ID:</label>
                                                                    <select name="destination_id" class="form-control" required>
                                                                        <option value="">Select Transport</option>
                                                                        @foreach($destinations as $destination)
                                                                            <option value="{{ $destination->id }}" {{ old('destination_id', $destination->id) == $destination->id ? 'selected' : '' }}>
                                                                                {{ $destination->nom }} <!-- Replace 'nom_trans' with the attribute you want to display -->
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                 </div>
                                                                <div class="form-group">
                                                                    <label for="transport_id">Transport:</label>
                                                                    <select name="transport_id" class="form-control" required>
                                                                        <option value="">Select Transport</option>
                                                                        @foreach($transports as $transport)
                                                                            <option value="{{ $transport->id }}" {{ old('transport_id', $itineraire->transport_id) == $transport->id ? 'selected' : '' }}>
                                                                                {{ $transport->nom_trans }} <!-- Replace 'nom_trans' with the attribute you want to display -->
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
