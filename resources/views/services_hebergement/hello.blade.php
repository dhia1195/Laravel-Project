<!DOCTYPE html>
<html>
<head>
    <title>Service Hébergement a été crée</title>
</head>
<body>
    <h1>Nouveau Service Hébergement</h1>
    <p>Bonjour,</p>
    <p>Le service <strong>{{ $serviceHebergement->service_nom }}</strong> a été ajouté avec succès chez {{ $serviceHebergement->hebergement->nom }}</p>

    <p>Détails :</p>
    <ul>
        <li>Nom du service : {{ $serviceHebergement->service_nom }}</li>
        <li>Description : {{ $serviceHebergement->description }}</li>
        <li>Disponibilité : {{ $serviceHebergement->disponibilite ? 'Disponible' : 'Indisponible' }}</li>
        <li>Prix : {{ $serviceHebergement->prix_service }}€</li>   
        <li>Type: {{ $serviceHebergement->hebergement->nom }}</li>
    </ul>

    <p>Merci,</p>
    <p>L'équipe</p>
</body>
</html>