<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';
    protected $fillable = ['id_film', 'id_user','rating_user', 'komentar', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film', 'id_film');
    }
} 