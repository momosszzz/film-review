<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    protected $table = 'tahun';
    protected $primaryKey = 'id_tahun';
    protected $fillable = ['tahun_rilis'];


    public function film(){
        return $this->belongsTo(Film::class, 'id_film', 'id_tahun');
    }
}
