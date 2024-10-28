<div class="card-body">
    <h5 class="card-title">
        <a href="{{ route('hebergements.show', $hebergement->id) }}" class="text-decoration-none">
            {{ $hebergement->titre }}
        </a>
    </h5>
    <p class="card-text">{{ Str::limit($hebergement->description, 100) }}</p>
    <ul class="list-unstyled">
        <li><strong>Nom:</strong> {{ $hebergement->nom }}</li>
        <li><strong>Type:</strong> {{ $hebergement->type }}</li>
        <li><strong>Adresse:</strong> {{ $hebergement->adresse }}</li>
        <li><strong>Pays:</strong> {{ $hebergement->pays }}</li>
        <li><strong>Ville:</strong> {{ $hebergement->ville }}</li>
        <li><strong>Capacité:</strong> {{ $hebergement->capacite }}</li>
        <li><strong>Prix par nuit:</strong> {{ $hebergement->prix_nuit }} €</li>
        <li><strong>Impact environnemental:</strong> {{ $hebergement->impact_environnemental }}</li>
    </ul>
    <!-- Add the Details button -->
    <a href="{{ route('hebergements.show', $hebergement->id) }}" class="btn btn-primary">Details</a>
</div>
