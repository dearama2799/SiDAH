<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use App\Models\Tamu;
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
        $buku_tamu->ket_tujuan = $ket_tujuan;
        $buku_tamu->tanda_tangan = $tanda_tangan;
        $buku_tamu->save();
        // dd($buku_tamu);

        return response()->json([
            "status" => "succes",
            "data" => $buku_tamu
        ]);
        
    }

    function list(Request $request){
        $list = BukuTamu::with('tamu','tujuan')->get();

        return response()->json([
            "status" => "succes",
            "data" => $list
        ]);
    }

    function update(Request $request){
        // dd($request->all());
        $list = BukuTamu::get();
        BukuTamu::where('id', $request->id)
        ->update([
            "tanggal"=>$request->tanggal,
            "id_tamu"=>$request->id_tamu,
            "id_tujuan"=>$request->id_tujuan,
            "ket_tujuan"=>$request->ket_tujuan,
            "tanda_tangan"=>$request->tanda_tangan
        ]);

        return response()->json([
            "status" => "Succes Update",
            "message" => $list
        ]);
    }

    
    function delete(Request $request){
        // dd($request->all());
        BukuTamu::where('id', $request->id)->delete();
        // dd($delete);
        // ->delete();

        // BukuTamu::where('id', $request->id)
        // ->delete();

        return response()->json([
            "status" => "Succes",
            "message" => "Data Berhasil di Hapus"
        ]);
    }

    function getDetailTamu($id){
        $tamu = Tamu::select(['id_tamu', 'nama_tamu', 'instansi', 'no_telpon'])->where('id_tamu', $id)->first();
        return response()->json([
            "status" => "Succes",
            "message" => "Sukses mendapatkan tamu",
            "data" => $tamu
        ]);
    }
}
