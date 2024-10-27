<x-layouts.app>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h1 class="mb-4">{{ $itineraire->titre }}</h1>
                <p class="lead">{{ $itineraire->description }}</p>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Details</h5>
                        <p class="card-text"><strong>Durée:</strong> {{ $itineraire->duree }} hours</p>
                        <p class="card-text"><strong>Prix:</strong> {{ $itineraire->prix }} €</p>
                        <p class="card-text"><strong>Difficulté:</strong> {{ $itineraire->difficulte }}</p>
                        <p class="card-text"><strong>Impact Carbone:</strong> {{ $itineraire->impact_carbone }} kg</p>
                    </div>
                </div>
                <div class="text-center">
                <img src="{{ asset('storage/' . $itineraire->image_url) }}" alt="{{ $itineraire->titre }}" class="img-fluid rounded shadow">

                </div>
            </div>
            <div class="col-md-4">
                <div class="sticky-top" style="top: 20px;">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Quick Links</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="{{ route('itineraires.index') }}" class="text-decoration-none">Back to List</a></li>
                                <li class="list-group-item"><a href="{{ route('itineraires.edit', $itineraire->id) }}" class="text-decoration-none">Edit Itinerary</a></li>
                                <li class="list-group-item">
                                    <form action="{{ route('itineraires.destroy', $itineraire->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Itinerary</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 1200px;
        }

        .lead {
            font-size: 1.25rem;
            font-weight: 300;
        }

        .card {
            border: 1px solid #eaeaea;
            border-radius: 8px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 500;
        }

        .card-text {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .img-fluid {
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .sticky-top {
            position: sticky;
            top: 20px;
        }
    </style>
</x-layouts.app>
