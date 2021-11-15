<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom", "numeroDeSerie", 
        "estDisponible", "type_article_id", "image"
    ];

    public function typeArticle()
    {
        return $this->belongsTo(TypeArticle::class);
    }

    public function tarifications()
    {
        return $this->hasMany(Tarification::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, "article_locations", "article_id", "location_id");
    }

    /*public function articleProprietes()
    {
        return $this->hasMany(ArticlePropriete::class, "article_propriete", 
        "article_id", "propriete_article_id");
    }*/

    public function proprietes()
    {
        return $this->belongsToMany(ProprieteArticle::class, "article_propriete", 
        "article_id", "propriete_article_id");
    }
}
