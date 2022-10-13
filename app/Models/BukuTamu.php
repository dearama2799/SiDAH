<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class BukuTamu extends Model 
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'kode_tamu', 'tanggal', 'id_tamu', 'id_tujuan', 'ket_tujuan', 'tanda_tangan'
    ];

    protected $table="buku_tamu";



    function tamu() {
        return $this->belongsTo(Tamu::class, 'id_tamu', 'id_tamu');
    }

    function tujuan(){
        return $this->belongsTo(Tujuan::class, 'id_tujuan', 'id_tujuan');
    }

}
