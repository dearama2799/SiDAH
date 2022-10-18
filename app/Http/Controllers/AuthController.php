<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
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

            //--- GENERATE TOKEN ----
            $key = 'secret';

            $payload = [
                'iss' => 'smkyaj',
                'aud' => 'smkyaj',
                'iat' => time(),
                'data' => [
                    'id' => $user->id, // id user login
                    'email' => $user->email // email user login
                ]
            ];
            
            $token = JWT::encode($payload, $key, 'HS256');
            //--- END GENERATE TOKEN ----



            if ($checkpassword) {
                return response()->json([
                    
                    "status" => "Succes",
                    "data" => [
                        'token' => $token,
                        'user' => $user
                    ]
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
