<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
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

    function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        // dd($email,$password);
        $user = User::where('email', $email)->first();
        // dd($check->toArray());

        if ($user != null) {
            $checkpassword = app('hash')->check($password, $user->password);

            if ($checkpassword) {
                return response()->json([
                    
                    "status" => "Succes",
                    "data" => $user
                ]);
            } else {
                return response()->json([
                    "status" => "Error",
                    "message" => "Password Salah"
                ], 401);
            }
        } else {
            return response()->json([
                "status" => "Error",
                "message" => "User Tidak Ditemukan"
            ], 401);
        }
    }

    //
}
