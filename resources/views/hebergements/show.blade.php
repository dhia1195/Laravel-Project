@extends('layouts.app')

@section('content')
    <h1>{{ $hebergement->nom }}</h1>
    <p>{{ $hebergement->description }}</p>
    <p>Type: {{ $hebergement->type }}</p>
    <p>Adresse: {{ $hebergement->adresse }}, {{ $hebergement->ville }}, {{ $hebergement->pays }}</p>
    <p>Prix par nuit: {{ $hebergement->prix_nuit }} €</p>
    <p>Impact environnemental: {{ $hebergement->impact_environnemental }}</p>
    @if($hebergement->image_url)
        <img src="{{ $hebergement->image_url }}" alt="{{ $hebergement->nom }}" />
    @endif
    <a href="{{ route('hebergements.index') }}">Retour à la liste</a>
@endsection
