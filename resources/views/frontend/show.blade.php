<x-layouts.base>

<div class="container">
    <h1>{{ $itineraire->titre }}</h1>
    <p>{{ $itineraire->description }}</p>
    <h2>Etapes</h2>
    @if($itineraire->etapes->isEmpty())
        <div class="alert alert-warning">No steps found for this itinerary.</div>
    @else
        <ul class="list-unstyled">
            @foreach($itineraire->etapes as $etape)
                <li>
                    <strong>{{ $etape->nom_etape }}</strong><br>
                    {{ $etape->description_etape }}<br>
                    <em>Order: {{ $etape->ordre_etape }}</em><br>
                    <em>Location: ({{ $etape->latitude }}, {{ $etape->longitude }})</em>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</x-layouts.base>
