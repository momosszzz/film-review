<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    protected $table = 'negara';
    protected $primaryKey = 'id_negara';
    protected $fillable = ['nama_negara'];

    public function film(){
        return $this->belongsTo(Film::class, 'id_film', 'id_negara');
    }
}
