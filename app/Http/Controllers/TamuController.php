<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;


class TamuController extends Controller
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

    function add(Request $request){
        $nama_tamu = $request->nama_tamu;
        $instansi = $request->instansi;
        $no_telpon = $request->no_telpon;
        // dd($nama_tamu, $instansi, $no_telpon);

        $tamu =new Tamu();
        $tamu->nama_tamu = $nama_tamu;
        $tamu->instansi = $instansi;
        $tamu->no_telpon = $no_telpon;
        $tamu->save();
        // dd($tamu);

        return response()->json([
            "status" => "succes",
            "data" => $tamu
            ]);

    }

    function list(Request $request){
        $list = Tamu::get();

        return response()->json([
            "status" => "succes",
            "data" => $list
        ]);
    }
    
    function update(Request $request){
        // dd($request->all());
        Tamu::where('id_tamu' , $request->id_tamu)
        ->update([
            "nama_tamu"=>$request->nama_tamu,
            "instansi"=>$request->instansi,
            "no_telpon"=>$request->no_telpon
        ]);

        return response()->json([
            "status" => "Data Berhasil Di Update"
        ]);
        
    }

    function delete(Request $request){
        Tamu::where('id_tamu', $request->id_tamu)
        ->delete();

        return response()->json([
            "status" => "Succes",
            "message" => "Data Berhasil Di Hapus"
        ]);
    }
}
