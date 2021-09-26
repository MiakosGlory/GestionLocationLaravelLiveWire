<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarification extends Model
{
    use HasFactory;

    protected $fillable = ["prix", "article_id", "duree_location_id"];

    public function dureeLocation()
    {
        return $this->belongsTo(DureeLocation::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
