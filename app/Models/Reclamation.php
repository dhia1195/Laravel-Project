<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;
    protected $table = 'reclamations';

    protected $fillable = [
        'titre',
        'description',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}