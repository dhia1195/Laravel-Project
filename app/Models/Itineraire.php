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
    ];
}
