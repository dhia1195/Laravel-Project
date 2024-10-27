<x-layouts.app>
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Transports</h5>
                            </div>
                            <a href="{{ route('transport.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Transport</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Environmental Impact </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transports as $transport)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $transport->nom_trans }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $transport->type_trans }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $transport->prix_trans }} dt</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $transport->impact_carbone }}</p>
                                        </td>
                                        <td class="text-center">
                                        <a href="{{ route('transport.show', $transport->id) }}" class="text-info mx-3" data-bs-toggle="tooltip" data-bs-original-title="Show transport">
                                                <i class="fas fa-eye text-secondary"></i> 
                                            </a>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTransportModal-{{ $transport->id }}">
                                                Edit
                                            </button>

                                         
                                           

                                         
                                            <!-- <form action="{{ route('transport.destroy', $transport->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="cursor-pointer bg-transparent border-0" data-bs-toggle="tooltip" data-bs-original-title="Delete transport">
                                                    <i class="fas fa-trash text-secondary"></i>
                                                </button>
                                            </form> -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $transport->id }}">
                                Supprimer
                            </button>

                            <!-- Confirmation Modal -->
                            <div class="modal fade" id="confirmDeleteModal-{{ $transport->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $transport->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $transport->id }}">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        Are you sure you want to delete this transport?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <form action="{{ route('transport.destroy', $transport->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        </td>
                                    </tr>

                                    
                                    <div class="modal fade" id="editTransportModal-{{ $transport->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Transport</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('transport.update', $transport->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="nom_trans">Name :</label>
                                                            <input type="text" name="nom_trans" class="form-control" value="{{ old('nom_trans', $transport->nom_trans) }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="type_trans">Type :</label>
                                                            <input type="text" name="type_trans" class="form-control" value="{{ old('type_trans', $transport->type_trans) }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="prix_trans">Price :</label>
                                                            <input type="number" name="prix_trans" class="form-control" value="{{ old('prix_trans', $transport->prix_trans) }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="impact_carbone">Impact Carbone :</label>
                                                            <input type="text" name="impact_carbone" class="form-control" value="{{ old('impact_carbone', $transport->impact_carbone) }}" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 
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
