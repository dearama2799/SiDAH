<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    function add(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = app('hash')->make($request->password);
        $roles = $request->roles;
        // dd($name,$email,$password);

        $user = new User();
        $user->name=$name;
        $user->email=$email;
        $user->password=$password;
        $user->roles=$roles;
        $user->save();
        // dd($user->id);

        return response()->json([
            "status" => "succes",
            "data" => $user
            ]);
    }
}
