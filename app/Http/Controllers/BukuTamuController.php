<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    function generateKode(){
        $countData = BukuTamu::count();
        $kode = "T";
        $length = 5;
        
        return $kode. str_pad($countData+1, $length, "0", STR_PAD_LEFT);

    }
    function add(Request $request){
        $kode_tamu = $this->generateKode();
        $tanggal = $request->tanggal;
        $id_tamu = $request->id_tamu;
        $id_tujuan = $request->id_tujuan;
        $ket_tujuan = $request->ket_tujuan;
        $tanda_tangan = $request->tanda_tangan;

        $buku_tamu = new BukuTamu();
        $buku_tamu->kode_tamu = $kode_tamu;
        $buku_tamu->tanggal = $tanggal;
        $buku_tamu->id_tamu = $id_tamu;
        $buku_tamu->id_tujuan = $id_tujuan;
        $buku_tamu->tanda_tangan = $tanda_tangan;
        $buku_tamu->save();
        dd($buku_tamu);

        return response()->json([
            "status" => "succes",
            "data" => $buku_tamu
        ]);
        
    }
}
