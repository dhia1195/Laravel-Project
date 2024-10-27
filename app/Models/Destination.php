<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $table = 'destination';
    protected $fillable = ['nom', 'description','pays','region','typeTourisme','impact_env','image_url'];
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
    public function itineraire()
    {
        return $this->hasMany(Itineraire::class);
    }
}
