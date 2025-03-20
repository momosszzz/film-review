<?php

namespace App\Models;

use App\Models\Negara;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "users";
    protected $primaryKey = "id_user";
    protected $fillable = ['name','usia','Negara','email','password','role','profile'];

    public function filterUsia(){
        return $this->hasMany(Film::class, 'id_film', 'for_usia');
    }
    
}

