<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';
    protected $primaryKey = 'id_genre';
    protected $fillable = ['nama_genre'];


    public function film(){
        return $this->belongsToMany(Film::class, 'film_genre', 'genre_id', 'film_id');
    }
}
