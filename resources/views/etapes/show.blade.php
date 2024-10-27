<x-layouts.app>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h1 class="mb-4">{{ $etape->nom_etape }}</h1>
                <p class="lead">{{ $etape->description_etape }}</p>

                <div class="details-section">
                    <h5 class="details-title">Details</h5>
                    <div class="details-item">
                        <strong>Ordre:</strong>
                        <span>{{ $etape->ordre_etape }}</span>
                    </div>
                    <div class="details-item">
                        <strong>Latitude:</strong>
                        <span>{{ $etape->latitude }}</span>
                    </div>
                    <div class="details-item">
                        <strong>Longitude:</strong>
                        <span>{{ $etape->longitude }}</span>
                    </div>
                    <div class="details-item">
                        <strong>Itinéraire:</strong>
                        <span>{{ $etape->itineraire->titre }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('etapes.edit', $etape->id) }}" class="btn btn-primary">Edit Step</a>
                    <form action="{{ route('etapes.destroy', $etape->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Step</button>
                    </form>
                    <a href="{{ route('etapes.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sticky-top" style="top: 20px;">
                    <div class="quick-links">
                        <h5 class="quick-links-title">Quick Links</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{ route('etapes.index') }}" class="text-decoration-none">Back to List</a></li>
                            <li class="list-group-item"><a href="{{ route('etapes.edit', $etape->id) }}" class="text-decoration-none">Edit Step</a></li>
                            <li class="list-group-item">
                                <form action="{{ route('etapes.destroy', $etape->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete Step</button>
                                </form>
                            </li>
                        </ul>
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

        .details-section {
            background: #f9f9f9;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .details-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .details-item {
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .details-item strong {
            color: #333;
        }

        .quick-links {
            background: #f9f9f9;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            padding: 20px;
        }

        .quick-links-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .list-group-item {
            border: none;
        }

        .btn {
            margin-right: 10px;
        }

        .sticky-top {
            position: sticky;
            top: 20px;
        }
    </style>
</x-layouts.app>
