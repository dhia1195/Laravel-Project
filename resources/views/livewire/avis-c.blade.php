<div>
    <main class="main-content">
        <div class="container-fluid py-4">
            <h2 class="mb-4">Manage Reviews</h2>
            
            <hr>

            <h3 class="mt-4">Reviews List</h3>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Reviews Table</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Destination </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commentaire</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Note</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($avis) === 0)
                                        <tr>
                                            <td colspan="5" class="text-center">No reviews found.</td>
                                        </tr>
                                    @else
                                    @foreach($avis as $review)
                                        <tr>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ $review->destination->nom }}</td>
                                            <td>{{ $review->commentaire }}</td>
                                            <td>{{ $review->note }}</td>
                                            {{-- <td>
                                                <button wire:click="edit({{ $review->id }})" class="btn btn-warning btn-sm">Edit</button>
                                                <button wire:click="delete({{ $review->id }})" class="btn btn-danger btn-sm">Delete</button>
                                            </td> --}}
                                        </tr>
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
