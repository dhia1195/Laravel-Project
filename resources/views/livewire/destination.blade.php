<div>
    <main class="main-content">
        <div class="container-fluid py-4">
            <h2 class="mb-4">Manage Destinations</h2>
            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" wire:model="nom" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" wire:model="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="pays">Pays</label>
                    <input type="text" class="form-control" id="pays" wire:model="pays" required>
                </div>
                <div class="form-group">
                    <label for="region">Region</label>
                    <input type="text" class="form-control" id="region" wire:model="region" required>
                </div>
                <div class="form-group">
                    <label for="typeTourisme">Type de Tourisme</label>
                    <input type="text" class="form-control" id="typeTourisme" wire:model="typeTourisme" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ $isEditMode ? 'Update' : 'Add' }}</button>
                @if ($isEditMode)
                    <button type="button" class="btn btn-secondary" wire:click="resetFields">Cancel</button>
                @endif
            </form>

            <hr>

            <h3 class="mt-4">Destinations List</h3>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Destinations Table</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pays</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Region</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type de Tourisme</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <div>
                                            @php
                                            //echo json_encode($destinations)
                                            @endphp

                                        </div>
                                       
                                        @if(count($destinations) === 0)
                                        <tr>
                                            <td colspan="6" class="text-center">No destinations found.</td>
                                        </tr>
                                    @else
                                    @foreach($destinations as $destination)
                                    @if($destination)
                                        <tr>
                                            <td>{{ $destination->nom ?? '' }}</td>
                                            <td>{{ $destination->description ?? '' }}</td>
                                            <td>{{ $destination->pays ?? '' }}</td>
                                            <td>{{ $destination->region ?? '' }}</td>
                                            <td>{{ $destination->typeTourisme ?? '' }}</td>
                                            <td>
                                                <button wire:click="edit({{ $destination->id }})" class="btn btn-warning btn-sm">Edit</button>
                                                <button wire:click="delete({{ $destination->id }})" class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">Invalid destination.</td>
                                        </tr>
                                    @endif
                                @endforeach
                                
                                    @endif
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
