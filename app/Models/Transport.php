<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $fillable = ['nom_trans', 'type_trans', 'prix_trans', 'impact_carbone'];
    public $timestamps = false; //yaaml updated_at w created_at
     public function transportit()
    {
        return $this->hasMany(TransportItineraire::class);
    }

}

