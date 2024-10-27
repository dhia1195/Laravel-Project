<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    use HasFactory;

    protected $table = 'itineraires';

    protected $fillable = [
        'titre',
        'description',
        'duree',
        'prix',
        'difficulte',
        'impact_carbone',
        'image_url',
        'destination_id',
    ];

    // Relation avec EtapeItineraire
    public function etapes()
    {
        return $this->hasMany(EtapeItineraire::class);
    }
    // Relation avec Itineraire
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
