<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hebergement extends Model
{
    use HasFactory;
    protected $table = 'hebergements';
    protected $fillable = [ 'nom', 
    'description', 
    'type',
    'adresse', 
    'pays',
    'ville',
    'prix_nuit',  // Attention à bien utiliser 'prix_nuit' ici et non 'prix'
    'impact_environnemental',
    'image_url'];

    public function servicehebs()
    {
        return $this->hasMany(ServiceHebergement::class);
    }
}
