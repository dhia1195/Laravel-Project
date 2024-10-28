@extends('layouts.app')

@section('content')
    <h1>{{ $service->service_nom }}</h1>
    <p>{{ $service->description }}</p>
    <p>Type: {{ $service->disponibilite }}</p>
    
    <p>Type: {{ $service->prix_service }}</p>
    
    <p>Type: {{ $service->hebergement->nom }}</p>
   <a href="{{ route('services_hebergement.index') }}">Retour à la liste</a>
@endsection
