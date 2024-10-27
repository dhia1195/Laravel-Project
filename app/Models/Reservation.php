<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Specify the table name if it doesn’t follow Laravel’s naming conventions
    protected $table = 'reservations';

    // Define fillable attributes
    protected $fillable = [
        'itineraire_id',
        'hebergement_id',
        'transport_id',
        'user_id',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class);
    }

    public function hebergement()
    {
        return $this->belongsTo(Hebergement::class);
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
