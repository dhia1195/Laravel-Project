<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHebergement extends Model
{
    protected $table = 'service_hebergements';
    protected $fillable = [
        'hebergement_id', // Clé étrangère vers la table 'hebergements'
        'service_nom', // Nom du service
        'description', // Description du service
        'disponibilite', // Indique si le service est disponible
        'prix_service' // Prix du service
    ];

    // Relation avec le modèle Hebergement
    public function hebergement()
    {
        return $this->belongsTo(Hebergement::class);
    }

}
