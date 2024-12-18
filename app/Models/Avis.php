<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;
    protected $table = 'avis';
    protected $fillable = ['user_id', 'destination_id','commentaire','date','note'];
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
