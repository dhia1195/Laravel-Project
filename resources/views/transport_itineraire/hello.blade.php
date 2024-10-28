<!DOCTYPE html>
<html>
<head>
    <title>transport itineraire a été crée</title>
</head>
<body>
    <h1>le transport a été crée</h1>
    <p>Bonjour,</p>
    <p>la distance<strong>{{ $transportItineraire->distance }}</strong> a été ajouté avec succès</p>

    <p>Détails :</p>
    <ul>
        <li>duree {{ $transportItineraire->duree }}</li>
      
    </ul>

    <p>Merci,</p>
    <p>L'équipe</p>
</body>
</html>