<x-layouts.app>
    <div class="container mt-5">
        <h1>Add a transport : </h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('transport.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom_trans">Name :</label>
                <input type="text" name="nom_trans" id="nom_trans" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type_trans">Type :</label>
                <input type="text" name="type_trans" id="type_trans" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prix_trans">Price :</label>
                <input type="number" name="prix_trans" id="prix_trans" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="impact_carbone">Impact :</label>
                <input type="text" name="impact_carbone" id="impact_carbone" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</x-layouts.app>
