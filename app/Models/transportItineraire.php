<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportItineraire extends Model
{
    use HasFactory;

    
    protected $table = 'transport_itineraires';

    
    protected $fillable = [
        'destination_id',
        'transport_id',
        'distance',
        'duree',
    ];

   
    
    
    public function Transport()
    {
        return $this->belongsTo(Transport::class);
    }
      
    public function Destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
