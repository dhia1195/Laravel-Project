<x-layouts.base>
    @include('layouts.navbars.guest.login') <!-- Adjust the path if needed -->

    <div class="container my-4">
        <h2 class="text-center">Add a Reclamation</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Reclamation Form -->
        <form action="{{ route('reclamations.store') }}" method="POST">
            @csrf <!-- CSRF Protection -->

            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Reclamation</button>
        </form>
    </div>
</x-layouts.base>