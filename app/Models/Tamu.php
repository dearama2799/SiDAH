<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Tamu extends Model 
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama_tamu', 'instansi', 'no_telpon'
    ];

    protected $table="tamu";


    // function buku_tamu() {
    //     return $this->hasMany(BukuTamu::class, 'id_tamu', 'id_tamu');
    // }

}
