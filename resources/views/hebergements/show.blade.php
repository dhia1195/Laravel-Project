@extends('layouts.app')

@section('content')
    <h1>Liste des Hébergements</h1>

    <!-- Search Form -->
    

    <ul>
        @foreach($hebergements as $hebergement)
            <li>
                <h2>{{ $hebergement->nom }}</h2>
                <p>{{ $hebergement->description }}</p>
                <p>Type: {{ $hebergement->type }}</p>
                <p>Adresse: {{ $hebergement->adresse }}, {{ $hebergement->ville }}, {{ $hebergement->pays }}</p>
                <p>Prix par nuit: {{ $hebergement->prix_nuit }} €</p>
                <p>Impact environnemental: {{ $hebergement->impact_environnemental }}</p>
                @if($hebergement->image_url)
                    <img src="{{ $hebergement->image_url }}" alt="{{ $hebergement->nom }}" />
                @endif
            </li>
        @endforeach
    </ul>

    {{-- Pagination links --}}
    {{ $hebergements->links() }}

    <a href="{{ route('hebergements.create') }}">Ajouter un nouvel hébergement</a>
@endsection
