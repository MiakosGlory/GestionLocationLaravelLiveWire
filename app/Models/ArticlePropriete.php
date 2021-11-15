<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlePropriete extends Model
{
    use HasFactory;

    protected $table = ("article_propriete");
    protected $fillable = [
        "article_id", 
        "propriete_article_id", 
        "valeur"
    ];

    /*public function typeArticle()
    {
        return $this->belongsTo(TypeArticle::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, "article_propriete", "propriete_article_id", "article_id");
    }*/
}
