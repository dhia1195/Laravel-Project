<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Destinations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Statistiques des Destinations</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Note Moyenne</th>
        </tr>
    </thead>
    <tbody>
        @foreach($destinations as $destination)
            <tr>
                <td>{{ $destination->nom }}</td>
                <td>{{ number_format($destination->avis_avg_note, 1) }} </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
