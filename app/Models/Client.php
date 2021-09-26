<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'pays',
        'sexe',
        'pieceIdentite',
        'numeroPieceIdentite',
        'ville',
        'telephone',
        'nationalite',
        'lieuNaissance',
        'dateNaissance'
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
