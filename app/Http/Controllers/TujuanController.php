<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use Illuminate\Http\Request;

class TujuanController extends Controller
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
        $nama_tujuan = $request->nama_tujuan;
        // dd($nama_tujuan);

        $tujuan = new Tujuan();
        $tujuan->nama_tujuan = $nama_tujuan;
        $tujuan->save();
        // dd($tujuan);

        return response()->json([
            "status" => "succes",
            "data" => $tujuan
        ]);
    }
}
