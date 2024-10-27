<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapeItineraire extends Model
{
    use HasFactory;
    protected $table = 'etapes_itineraires';

    protected $fillable = [
        'itineraire_id',
        'nom_etape',
        'description_etape',
        'ordre_etape',
        'latitude',
        'longitude',
    ];

    // Relation avec Itineraire
    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class);
    }
}
