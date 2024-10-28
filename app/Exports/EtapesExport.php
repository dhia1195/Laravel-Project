<?php
namespace App\Exports;

use App\Models\EtapeItineraire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EtapesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch all steps with relevant data
        return EtapeItineraire::with('itineraire')->get()->map(function ($etape) {
            return [
                'Nom de l\'Étape' => $etape->nom_etape,
                'Description' => $etape->description_etape,
                'Ordre' => $etape->ordre_etape,
                'Latitude' => $etape->latitude,
                'Longitude' => $etape->longitude,
                'Itinéraire' => $etape->itineraire->titre,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nom de l\'Étape',
            'Description',
            'Ordre',
            'Latitude',
            'Longitude',
            'Itinéraire',
        ];
    }
}
