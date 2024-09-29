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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prix</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Impact Carbone</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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
                                            <p class="text-xs font-weight-bold mb-0">{{ $transport->impact_carbone }} </p>
                                        </td>
                                        <td class="text-center">
    <a href="{{ route('transport.edit', $transport->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit transport">
        <i class="fas fa-user-edit text-secondary"></i>
    </a>
    <a href="{{ route('transport.show', $transport->id) }}" class="text-info" data-bs-toggle="tooltip" data-bs-original-title="Show transport">
    <i class="fas fa-eye text-secondary"></i> 
</a>

    <form action="{{ route('transport.destroy', $transport->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="cursor-pointer bg-transparent border-0" data-bs-toggle="tooltip" data-bs-original-title="Delete transport">
            <i class="fas fa-trash text-secondary"></i>
        </button>
    </form>
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
