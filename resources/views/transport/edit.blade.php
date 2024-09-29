<x-layouts.app>
    <div class="container mt-5">
        <h1>Update</h1>
        <form action="{{ route('transport.update', $transport->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="nom_trans">Name:</label>
                <input type="text" class="form-control" name="nom_trans" value="{{ old('nom_trans', $transport->nom_trans) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="type_trans">Type:</label>
                <input type="text" class="form-control" name="type_trans" value="{{ old('type_trans', $transport->type_trans) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="prix_trans">Price:</label>
                <input type="text" class="form-control" name="prix_trans" value="{{ old('prix_trans', $transport->prix_trans) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="impact_carbone">Impact Carbone:</label>
                <input type="text" class="form-control" name="impact_carbone" value="{{ old('impact_carbone', $transport->impact_carbone) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-layouts.app>
